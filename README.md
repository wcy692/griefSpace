# What is griefSpace
griefSpace is a digital mourning space aiming to provide users with a private space to write journals and visualise their changes in emotions. It aims to adopt the principle of story-telling approach to simulate the process of Cognitive behavioural therapy (CBT).

# Setup
### Please go to the ./doc/supporting_materials folder and follow the setup guide to have your local folders and phpMyAdmin set up.
### Also check out the video setup guide on YouTube. Link: https://youtu.be/7d6nicD7PAk

# Feature
### 1. Journalling System
- **Creating, Editing, Reviewing:** griefSpace provides a private space to let users create journal, edit contents and review answer.<br/>
- **Creating journal:** users can create up to one journal every day.<br/>
- **Changing Answer when creating:** Users can easily change any question(s) or answers, its title and user's emotion when creating a journal by simply clicking on the        'before' button.<br/>
- **Viewing a journal's content:** Users can select a journal and review its content anytime by clicking on the desired journal on the journal panel. Preview.php allows      users to view a journal's title, user's emotion and all possible questions whereas details.php show all answers of a selected question.<br/>
- **Editing contents after creating:** Users can go back to a journal anytime and change its content by simply clicking on the 'edit' symbol on the preview panel.<br/>

### 2. Insight Panel
- **A workable calendar**: a calendar suppots users to navigate to the previous or next month by clicking the arrow buttons.
- **Day cell's string and its background colour**: Each day cell is populated with a emotion-represented string and set to have a specific background color according to the emotion selected by users when they create a journal.
- **Clickable day cell**: Users can click on any day cell to activate a click event. The application will bring users to review a journal if the journal was created on that day.

### 3. Settings
- **Support changing email and password**
- **Customisable notification settings**: Allows users to select which event should they receive an alert email. Currently supports 'changing email', 'changing password', 'alert on journal created', 'alert on journal updated' and 'login alert'.
- **Two-factor authentication**: By turing this setting on, users will receive a one-time password via email after they make every login attempt.
