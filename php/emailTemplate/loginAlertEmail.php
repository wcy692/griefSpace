<?php

  function getSubject(){
    return "Login alert for your account";
  }

  function getBody($dateStamp, $timezone){
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
                       line-height: 1.1;'>Activity alert: <br>someone has logged on your account</h1>
                       <p style='font-size: 20px;
                        margin: 8px 0;
                        line-height: 1.3;
                        text-align:center;'>Hello there, this is a notification email to inform that a login attempt has been recorded.
                                              <br> If you wanna stop receiving this notification, you might log on and change it on the setting page.</p>
                        <div style='background: #e6e6e6;
                                    padding: 20px 0;
                                    margin: 8px 0;'>
                          <p style='font-size: 20px;
                                     margin: 8px 0;
                                     line-height: 1.3;
                                     text-align:center;'>Activity: Login attempt</p>
                          <p style='font-size: 20px;
                                     margin: 8px 0;
                                     line-height: 1.3;
                                     text-align:center;'>Time: $dateStamp</p>
                          <p style='font-size: 20px;
                                    margin: 8px 0;
                                    line-height: 1.3;
                                    text-align:center;'>Time zone: $timezone</p>
                        </div>
                        <div style='padding: 24px 0;text-align:center;'>
                        <a href='http://localhost/griefSpace/html/login.php' style='border-radius: 20px;
                      padding: 10px 16px;
                      font-size: 20px;
                      color: #FFFEFE;
                      background: #FFB72A;'>Login now</a>
                      <p style='font-size: 20px;
                        margin: 20px 0 8px 0;
                        line-height: 1.3;'>If that wasn't you, we recommend to reset your password.</p>
                        <div style='padding: 24px 0;text-align:center;'>
                        <a href='http://localhost/griefSpace/html/resend/getResetPwdLetter.php' style='border-radius: 20px;
                      padding: 10px 16px;
                      font-size: 20px;
                      color: #ff9b00;
                      border: 2px solid #ff9b00;
                      background: rgb(220, 219, 219, 0.3);'>Reset Password</a></div>
            </div>
          </div>
        </section>
      </body>
    </html>";
  }


 ?>
