# NiceTrip - Share your travels

Developed by:
- [Lorenzo Colletta](https://github.com/LorenzoColletta)
- [Domenico Giacobbi](https://github.com/giacobbidomenico)

## Introduction

Nicetrip is a social network for passionate travellers. Post your photos, tell about your journey or get inspired by those of your followers.

## Features

1. [Sign up & Login](#sign-up--login)
2. [Post Managment](#post-managment)
3. [Profile Managment](#post-managment)
   - [Visualization and Follow](#visualization-and-follow)
   - [Settings](#settings)
4. [Feed](#feed)
5. [Notifications](#notifications)
6. [Security](#security)
7. [Used Technologies](#security)

## Sign up & Login
To use the platform, the user must be registered. During the registration phase, your personal details, your e-mail address and a specific password are requested. 
To complete the registration process, an email will be sent to the user with a link to the account confirmation page.
Account verification is required to log in.
Login page includes also the possibility to stay logged in for a specific amount of time.

## Post Managment
A post is the story of a trip with related photos and itinerary.
The website allows you to view, publish and interact with posts.
For the publication of a post, the insertion of a title and a description is required. it is also possible to insert images and the destinations visited.
A list of post previews can be viewed in a special section on the user page.
The preview of a post shows its title, images and a brief statistic (number of comments and likes) and eventually allows its deletion.
It also allows you to go to the page dedicated to viewing the post in full.
A user can interact with another user's post by liking and commenting. it is possible to like both from the preview of the post, and on the full view page.
Comments can only be viewed and placed on the full post viewing page.

## Profile Managment
The site has two main pages dedicated to displaying user data.

### Visualization and Follow
From the user profile page it is possible to:
- see the user's profile picture and username
- see the list of thumbnails of posts published by the user
- see the list of users followed by the user
- see the list of users who follow you
- start following the user
- unfollow the user
A user's profile page can be accessed by any user.

### Settings
The settings page is accessible only by its user and allows him to modify his profile data such as:
- profile picture;
- username;
- e-mail;
- password;

## Feed
In the feed you can view the posts published by the users you follow, like them and access their extended version which allows you to comment and view the comments of others.
Once a post has been viewed, it will no longer be available in the feed.

## Notifications
A user receives a notification when another user starts following his account, likes or comments his post.
Each notification is sent via e-mail to the user's address.
Notifications can be viewed in a special section of the platform, where once viewed they are no longer available.

## Security
Security management was implemented through:
- encryption of passwords before saving on the db
- use of a code generated using a secure hash function, to implement the function stay connected
- use of a code generated using a secure hash function, to implement account verification

## Used Technologies
The technologies used are:
- [bootstrap](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [phpmailer](https://github.com/PHPMailer/PHPMailer) - php library used to send emails for notifications and account confirmation
- [bingmaps api](https://learn.microsoft.com/en-us/bingmaps/) - used to carry out the suggestion of destinations in the publication of a post
- ajax by means of [axios](https://axios-http.com/)
