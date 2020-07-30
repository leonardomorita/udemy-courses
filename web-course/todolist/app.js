const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');

// const date = require(__dirname + '/date.js');

const app = express();

app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded( { extended: true } ));
app.use(express.static("public"));

mongoose.connect("mongodb://localhost:27017/todolist", {useNewUrlParser: true, useUnifiedTopology: true});

const activitySchema = new mongoose.Schema ({
    name: {
        type: String,
        required: true
    }
});

const listSchema = {
    name: String,
    items: [activitySchema]
};

const Activity = mongoose.model('Activity', activitySchema);
const List = mongoose.model('List', listSchema);

app.get('/', function (req, res) {
    // const day = date.getDate();

    Activity.find({}, {"name": true}, function (err, activities) {
        if (err) {
            console.log(err);
        } else {
            if (activities.length === 0) {
                const playSports = new Activity ({
                    name: "Play sports"
                });

                const read = new Activity ({
                    name: "Read"
                });

                const study = new Activity ({
                    name: "Study"
                });

                Activity.insertMany([playSports, read, study], function (err) {
                    if (err) {
                        console.log(err);
                    } else {
                        console.log("OK!");
                    }
                });
            }

            res.render('list', {listTitle: "Today", activities: activities});
        }
    });
});

app.get('/:name', function (req, res) {
    const listName = req.params.name;

    List.findOne({name: listName}, function (err, list) {
        if (!err) {
            if (!list) {
                const list = new List({
                    name: listName,
                    activities: []
                });
            
                list.save();
                res.redirect('/' + listName);
            } else {
                return res.render('list', {listTitle: list.name, activities: list.activities});
            }
        }
    });
    // res.render("list", {listTitle: "Work"});
});

app.post('/', function (req, res) {
    const activityName = req.body.activity;

    const activity = new Activity({
        name: activityName
    });

    // Salva o registro no banco de dados
    activity.save();

    res.redirect('/');
});

app.post('/delete', function (req, res) {
    const activityId = req.body.checkbox;
    
    Activity.deleteOne({_id: activityId}, function (err) {
        if (err) {
            console.log(err);
        } else {
            res.redirect('/');
        }
    })
});

app.post('/work', function (req, res) {
    const item = req.body.activities;
    

    res.redirect("/work");
});

app.get('/about', function (req, res) {
    res.render('about');
});

app.listen(3000, function () {
    console.log("The server is running on port 3000.");
});