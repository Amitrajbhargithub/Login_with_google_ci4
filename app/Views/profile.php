<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 10%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<div id="id01" class="modal">
  
    <div class="modal-content animate">
        <div class="imgcontainer">
            <span class="close" title="Close Modal">&times;</span>
            <img <?php if(session()->get("LoggedUserData")['profile_img']) { ?> src="<?=session()->get("LoggedUserData")['profile_img'];  ?>" <?php }{ ?>  src="https://www.w3schools.com/howto/img_avatar2.png"<?php } ?> alt="Avatar" class="avatar">
        </div>

        <div class="container">
                <h4>Name: <?=session()->get("LoggedUserData")['name']?session()->get("LoggedUserData")['name']:"";  ?></h4><br>
                <h4>Email: <?=session()->get("LoggedUserData")['email']?session()->get("LoggedUserData")['email']:"";  ?></h4><br>
        </div>
    </div>
</div>
</body>
</html>
