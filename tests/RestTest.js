var http = require('http');  

var qs = require('querystring');  

var data = {  
a: 123,  
time: new Date().getTime()};//这是需要提交的数据  


var content = qs.stringify(data);  

var options = {  
hostname: '127.0.0.1',  
port: 8000,  
//path: '/oauth?' + content,  
path: '/oauth/clients',  
method: 'GET',
headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest'
    }
};  

var req = http.request(options, function (res) {  
console.log('STATUS: ' + res.statusCode);  
console.log('HEADERS: ' + JSON.stringify(res.headers));  
res.setEncoding('utf8');  
res.on('data', function (chunk) {  
    console.log('BODY: ' + chunk);  
});  
});  

req.on('error', function (e) {  
console.log('problem with request: ' + e.message);  
});  

req.end();  
