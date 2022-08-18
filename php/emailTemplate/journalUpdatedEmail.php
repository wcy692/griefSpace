<?php

  function getSubject(){
    return "Activity alert for your account";
  }

  function getBody(){
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
                       line-height: 1.1;'>Activity alert: journal updated</h1>
                       <p style='font-size: 20px;
                        margin: 8px 0;
                        line-height: 1.3;
                        text-align:center;'>Hello there, this is a notification email to inform the content of one of your journals was changed by your request.
                                          <br> If you wanna stop receiving this notification, you might log on and change it on the setting page.</p>
                        <div style='padding: 24px 0;text-align:center;'>
                        <a href='http://localhost/griefSpace/html/login.php' style='border-radius: 20px;
                      padding: 10px 16px;
                      font-size: 20px;
                      color: #FFFEFE;
                      background: #FFB72A;'>Login now</a></div>
            </div>
          </div>
        </section>
      </body>
    </html>";
  }

 ?>
