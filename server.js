const mysql=require("mysql");
const express=require("express");
const bodyParser=require("body-parser");
const path=require("path");

var app=express();
app.use(bodyParser.json());    //to support JSON encoded bodies

app.use(express.json({limit: '1tb'}));

var mysqlConnection=mysql.createConnection({
    host: "192.168.1.160",
    port: 3306,
    user: "iotdata",
    database: "SHMDB",
    password: "csir.ceeri",
});

//var queryString= "SELECT Temperature FROM ISL201 ORDER BY ISL201.Timestamp DESC";

mysqlConnection.connect((err)=>{
    if (!err){
        console.log("Wow! Connection Established");
    }
    else {
        console.log("Opps! Connection Failed" + JSON.stringify(err,undefined,2));
    }
});

var server=app.listen(3000, function(){
    var port= server.address().port
    console.log("http://localhost:%s", port)
});

app.use(express.static('./'));

app.get('/getTemperature', function (req, res) {
	res.sendFile(path.join(__dirname + './index.html'));
});


app.get('/test', function (req, res) {
	mysqlConnection.query(queryString, function(err, rows, fields) {
		if (err) throw err;
		res.send(formatData(rows));
	});
});

//mysqlConnection.connect(function(err){
//    if (!err);
//    mysqlConnection.query("SELECT * FROM ISL201 ORDER BY ISL201.Timestamp DESC", function(err, results){
//        if (!err);
//        console.log(results);
//    });
//});
