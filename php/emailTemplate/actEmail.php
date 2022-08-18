<?php

  function getSubject(){
    return "Your new activation email arrived!";
  }

  function getBody($token){
    return "<!DOCTYPE html>
    <html lang='en' dir='ltr'>
      <body style='background:#F8F5F2;font-family: sans-serif;'>
        <section>
          <h1 style='font-size:32px;
                  color:#9066E9;
                  text-align:center;
                  margin:32px 0;
                  font-family: fantasy;
                  letter-spacing: 2px;
                  font-weight: 500;'>griefSpace</h1>
         <div style='background: #FFFFFF;
                    color: #414141;
                    padding: 32px 0 48px 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                    max-width: 80%;
                    min-width: 50%;
                    margin: auto;'>
            <div style='max-width: 80%;
                      margin: auto;'>
                      <h1 style='font-size: 48px;
                       text-align: center;
                       color: #9066E9;
                       margin-bottom: 32px;
                       line-height: 1.1;'>Your new activation email are here!</h1>
                       <p style='font-size: 20px;
                        margin: 8px 0;
                        line-height: 1.3;'>Hello there, you\'ve just requested a new activation email. Please click the button below to finish the activation procedure.</p>
                      <p style='font-size: 20px;
                        margin: 8px 0;
                        line-height: 1.3;'>If that wasn't you submitting this request, please ignore this email.</p>
                        <div style='padding: 24px 0;text-align:center;'>
                        <a href='http://localhost/griefSpace/html/activationPage.php?token=$token' style='border-radius: 20px;
                      padding: 10px 16px;
                      font-size: 20px;
                      color: #FFFEFE;
                      background: #FFB72A;'>Activate now</a></div>
                      <p style='margin: 8px 0;
                      line-height: 1.3;
                      font-size: 16px;
                      font-weight: bold;
                      color: #797979;
                      text-align:center;'>Reminder: this activation link will be expired in 30 minutes.</p>
            </div>
          </div>
        </section>
      </body>
    </html>";
  }

 ?>
