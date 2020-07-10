const express = require('express');
const bodyParser = require('body-parser');
const date = require(__dirname + '/date.js');

const app = express();
app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static("public"));

const activities = [];
const works = [];

app.get('/', function (req, res) {
    const day = date.getDate();

    res.render('list', {listTitle: day, activities: activities});
});

app.post('/', function (req, res) {
    const activity = req.body.activity;

    if (req.body.button === "Work") {
        works.push(activity);
        res.redirect("/work");
    } else {
        activities.push(activity);
        res.redirect('/');
    }
});

app.get('/work', function (req, res) {
    res.render("list", {listTitle: "Work", activities: works});
});

app.post('/work', function (req, res) {
    const item = req.body.activities;
    works.push(item);

    res.redirect("/work");
});

app.get('/about', function (req, res) {
    res.render('about');
});

app.listen(3000, function () {
    console.log("The server is running on port 3000.");
});