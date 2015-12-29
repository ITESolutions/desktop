<!DOCTYPE html>
<html>
    <head>
        <link href="/video.css" rel="stylesheet" type="text/css"/>
        
        <style>
            #login input {
                height: 24px;
                width: 250px;
            }
        </style>
    </head>
    <body>
        <video id="bgvid" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
            <source src="/video/bg1.mp4" type="video/mp4">
            <source src="/video/bg1.webm" type="video/webm">
        </video>
        <div id="login" style="text-align: center;">
            <h1>Cura</h1>
            <form>
                <label for="username">Username:</label>
                <input name="username"
                       id="username"
                       placeholder="username@host.com"
                       />
                <br>
                <label for="password">Password:</label>
                <input name="passowrd"
                       id="password"
                       type="password"
                       placeholder=""
            </form>
            <button id="login">Login</button>
        </div>
        
    </body>
</html>
