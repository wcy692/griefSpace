<?php

  function getSubject(){
    return "You've activated your account!";
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
                       line-height: 1.1;'>You've activated your account!</h1>
                       <p style='font-size: 20px;
                        margin: 8px 0;
                        line-height: 1.3;'>Congrats, you\'ve just activated your account. From now on, you can enjoy all the features on our application. We look forward to seeing you again.</p>
                        <div style='padding: 24px 0;text-align:center;'>
                        <a href='http://localhost/griefSpace/html/login.php' style='border-radius: 20px;
                      padding: 10px 16px;
                      font-size: 20px;
                      color: #FFFEFE;
                      background: #FFB72A;'>Login now</a></div>
                      <p style='font-size: 20px;
                        margin: 20px 0 8px 0;
                        line-height: 1.3;'>If that wasn't you submitting this request, please contact our staff immediately. You might also consider resetting your password.</p>
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
