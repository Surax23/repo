<style type="text/css">
/*
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 3.0 License

Name       : Accumen
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120712
*/

* {
	margin: 0;
	padding: 0;
}

a {
	text-decoration: underline;
	color: #FF381A;
}

a:hover {
	text-decoration: none;
}

body {
	line-height: 1.75em;
	background: #176093;
	font-size: 11.5pt;
	color: #5A6466;
}

body,input {
	font-family: Verdana, Helvetica, Arial, sans-serif;
}

table, tr, td {
	border: solid 1px;
	border-collapse: collapse;
	padding: 15 15 15 15;
}

td {
	width: 230;
}

br.clearfix {
	clear: both;
}

h1,h2,h3,h4 {
	
	font-weight: normal;
}

h2 {
	font-size: 1.8em;
}

h2,h3,h4 {
	font-family: 'Droid Sans', 'Open Sans', 'Trebuchet MS', Helvetica, Arial, sans-serif;
	color: #2A3436;
	margin-bottom: 1em;
}

h3 {
	font-size: 1.25em;
}

#news h3, #games h3 {
	margin-bottom: 5px;
}

h4 {
	font-size: 1em;
}

img.alignleft {
	float: left;
	margin: 5px 30px 20px 0;
}

img.aligntop {
	margin: 5px 0 20px 0;
}

input[type="input"] {
	width: 350;
}

p {
	margin-bottom: 1.5em;
}

textarea[name="text"] {
	width: 350;
	height: 200;
}

ul {
	margin-bottom: 1.5em;
}

ul h4 {
	margin-bottom: 0.35em;
}

a {
	color: #2A3436;
}

.b-container{
    width:200px;
    height:150px;
    background-color: #ccc;
    margin:0px auto;
    padding:10px;
    font-size:30px;
    color: #fff;
}
.b-popup{
    width:100%;
    min-height:100%;
    background-color: rgba(0,0,0,0.5);
    overflow:hidden;
    position:fixed;
    top:0px;
}
.b-popup .b-popup-content{
    margin:40px auto 0px auto;
    width:100px;
    height: 40px;
    padding:10px;
    background-color: #c5c5c5;
    border-radius:5px;
    box-shadow: 0px 0px 10px #000;
}

.box {
	margin: 0 0 50px 0;
}

.games {
	margin: 0 0 80px 0;
}

#content {
	padding: 0;
	width: 840px;
	margin: 0 0 0 65px;
}

#footer {
	padding: 50px 0 80px 0;
	text-align: center;
	text-shadow: 1px 1px 0px rgba(30,30,30,0.7);
	color: #fff;
}

#footer a {
	color: #587477;
}

#header {
	height: 130px;
	padding: 40px;
	position: relative;
}

#logo {
	position: absolute;
	top: 40px;
	left: 40px;
	height: 130px;
	line-height: 130px;
}

#logo a {
	color: #2A3436;
	text-decoration: none;
}

#logo h1 {
	font-family: "Open Sans", sans-serif;
	text-transform: uppercase;
	font-size: 3em;
}

#menu {
	line-height: 57px;
	position: absolute;
	right: 40px;
	top: 76px;
	height: 57px;
	font-family: Arial, sans-serif;
}

#menu a {
	text-transform: uppercase;
	text-decoration: none;
	color: #1C1C1C;
	font-size: 1.2em;
}

#menu ul {
	padding: 0 20px 0 20px;
	list-style: none;
}

#menu ul li {
	display: inline;
	padding: 10px 10px 10px 10px;
	margin: 0 8px 0 8px;
	background: #FAFAFA;
	border: solid 1px #e4e4e4;
	box-shadow: inset 0px 0px 0px 1px #fff;
	text-shadow: 1px 1px 0px rgba(255,255,255,0.9);
}

#menu ul li.inactive {
	
}

#menu ul li.active a {
	color: #403B31;
}

#page {
	margin: 0;
	position: relative;
	width: 900px;
	padding: 0px 40px 0 40px;
}

#page .section-list {
	padding-left: 0;
	list-style: none;
}

#page .section-list li {
	padding: 25px 0 25px 0;
	clear: both;
}

#page ul {
	list-style: none;
}

#page ul li {
	border-top: solid 1px #DDD;
	padding: 10px 0 10px 0;
}

#page ul li.first {
	padding-top: 0;
	border-top: 0;
}

#page-bottom {
	padding: 40px 40px 0 40px;
	color: #302F2C;
	background: #F2EBDE;
	position: relative;
	width: 898px;
	border-top: solid 1px #BFB5A4;
	box-shadow: inset 0px 0px 0px 1px #fff;
	text-shadow: 1px 1px 0px rgba(255,255,255,0.9);
}

#page-bottom a {
	color: #1B1A18;
}

#page-bottom h2, #page-bottom h3, #page-bottom h4 {
	color: #3F3D39;
}

#page-bottom ul {
	list-style: none;
}

#page-bottom ul li {
	border-top: solid 1px #BAB5AB;
	padding: 10px 0 10px 0;
}

#page-bottom ul li.first {
	border-top: 0;
	padding-top: 0;
}

#page-bottom-content {
	width: 615px;
	margin: 0 0 0 285px;
}

#page-bottom-sidebar {
	float: left;
	width: 250px;
}

#sidebar {
	position: relative;
	left: 10px;
	top: -50px;
	width: 914px;
	background: rgb(250, 250, 250);
	padding: 20px;
	border: solid 1px #D6E0E2;
	margin: 0 10px 0 0;
	text-shadow: 1px 1px 0px rgba(30,30,30,0.1);
	box-shadow: inset 0px 0px 0px 1px #fff;
	color: #000;
}

#wrapper {
	width: 978px;
	position: relative;
	background: #FFF;
	margin: 0 auto 0 auto;
	box-shadow: 0px 0px 150px 0px rgba(0,0,0,0.15);
	border: solid 1px #82A7AD;
	border-top: 0;
}
</style>