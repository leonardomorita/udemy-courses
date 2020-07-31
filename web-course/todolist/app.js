const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const _ = require('lodash');

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
    activities: [activitySchema]
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
    const listName = _.capitalize(req.params.name);

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
                res.render('list', {listTitle: list.name, activities: list.activities});
            }
        }
    });
    // res.render("list", {listTitle: "Work"});
});

app.post('/', function (req, res) {
    const activityName = req.body.activity;
    const listName = req.body.list;

    const activity = new Activity({
        name: activityName
    });

    // Compara se o nome da lista é a padrão, que seria o 'Today'
    if (listName === "Today") {
        // Salva o registro no banco de dados
        activity.save();
        res.redirect('/');
    } else {
        List.findOne({name: listName}, function (err, list) {
            if (!err) {
                // Adiciona a atividade no array
                list.activities.push(activity);
                // Salva no banco de dados
                list.save();

                res.redirect('/' + listName);
            }
        });
    }
});

app.post('/delete', function (req, res) {
    const activityId = req.body.checkbox;
    const listName = req.body.listName;
    
    if (listName === "Today") {
        Activity.deleteOne({_id: activityId}, function (err) {
            if (err) {
                console.log(err);
            } else {
                res.redirect('/');
            }
        });
    } else {
        // No primeiro parâmetro verifica qual a lista (documento) que vai ser manipulada.
        // No segundo parâmetro será especificado o que vai ser atualizado. No caso, foi utilizado o $pull, que seria a remoção de itens.
        // No terceiro parâmetro é o 'callback'.
        List.findOneAndUpdate({name: listName}, {$pull: { activities: { _id: activityId } }}, function (err, list) {
            if (!err) {
                res.redirect('/' + listName);
            }
        });
    }

    
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