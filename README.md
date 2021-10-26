# Forum Website
#Introduction: 

My idea is to make a basic social media site that will allow people to follow other users and post threads and replies to threads within different message boards. The message boards will consist of two variants, closed boards (open to specific users) and general boards (open to everyone). Admins can create different boards as they see fit. This site will be open to anyone looking to discuss topics specified by each board. It will function similarly to Reddit and old forum sites in that it uses threads and replies over timelines and follower feeds, however it will differ since users can follow other users. Users can vote on threads to determine where they show up on the board’s homescreen (higher votes show up first). Users can also add friends and will be alerted when they post and can see an archive of their posts.

#Functional Requirements:

A person should be able to create one account which will be identified by their username and email. Normal users and admins can follow other users, post threads, and reply to threads, however, administrators will be able to create/manage threads which would include the roles of deleting replies/threads and banning users who violate the rules of the site. Admins will have to manage at least 1 board. Users can only post on boards they have joined and/or are whitelisted on. All users will be able to vote on threads giving them a thumbs up or thumbs down affecting the thread’s ranking. Finally, all users can add other users as friends which would allow them to see a collection of the other user’s posts and get alerts when they post something new.

#Data Requirements:

For each site member the database will store their name, age (which cannot be null), whether they are banned or not, their bio, and their email and username. The username uniquely identifies a user on the site for everyone else and the email verifies that a user isn’t creating more than one account.

A site member can also be an admin which gives them the ability to create/manage a board. The creator of the board is automatically a manager of it, however an admin can be invited to manage other boards they did not create.

Each board will have a unique name and a description of what the purpose/rules of the board are. 

Each user can vote on a thread which will be stored in the thread table. Also stored will be the image submitted (if a user chose one), the date of the post (not null), the title of the thread which is a weak key identifying the thread, and finally the body of the thread (not null). Threads can also be marked as “restricted” which will contain a whitelist of users allowed to reply to the thread (not null) thereby blocking certain users from interacting with it.

Users can comment on each thread. The comments will contain an image, the date posted (not null), and the text of the comments (not null).

#Prioritization:

##Essential: 
- Ability to create an account
- Ability for an user to post a thread
- Ability for an user to post a comment

##Important:
- Ability for an admin to create a board
- Ability for users to vote on threads

##Nice:
- Ability to ban users
- Ability to restrict threads

##Extra:
- Ability to follow other users


#Credits/Resources:

I got all of my information from just looking at other systems and thinking about how they might function, specifically Reddit and the forums on BodyBuilding.com. All data will come from users who access and use the site. 
