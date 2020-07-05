const express = require('express');
const bodyParser = require('body-parser');

const app = express();
app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static("public"));

var activities = [];

app.get('/', function (req, res) {
    var today = new Date();
    var currentDay = today.getDay();
    var options = {
        weekday: "long",
        day: "numeric",
        month: "long"
    };
    var kindDay = "";

    if (currentDay === 6 || currentDay === 0) {
        kindDay = "Weekend";
    } else {
        kindDay = "Weekday";
    }

    var day = today.toLocaleDateString("en-US", options); // pt-BR

    res.render('list', {kindOfDay: kindDay, weekname: day, activities: activities});
});

app.post('/', function (req, res) {
    var activity = req.body.activity;
    activities.push(activity);

    res.redirect('/');
});

app.listen(3000, function () {
    console.log("The server is running on port 3000.");
});