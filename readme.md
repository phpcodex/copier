## About Copier

This Copier package was built only with a view of demonstrating
the advantages of separating out your codes responsibility. 
To illustrate the differences between what a Controller 
does and how a Provider differs.

Key notes:

- Logic separation helps move packages to other systems easily
- Architecture directs to you the problem easier
- Well structured code keeps file sizes small better to maintain
- Write your code for the next developer reading it

## Understanding the task

If your specification suggest you to move files from **C:** to **D:**
don't lock down your code to do just that. Think outside the box, 
think **some location** rather than a **fixed location** and what 
if the disk changes.

- Local disk
- FTP or sFTP
- S3 bucket
- Email attachments

## FYI

I didn't use the Laravel Flysystem to act as a 'disk' in this project
as I just wanted to illustrate that a simple PHP copy() function
could be written in a few seconds but there are so many things that
could go wrong

- Source file doesn't exist
- Destination file already exists
  - Do you want to retain this or overwrite it?
  - Do you want to make a backup if you're overwriting?
- What if the destination isn't writable.

Thus a package to handle the task is beneficial but also the 
way it is written will help the next developer fault diagnose
or have a hard time figuring things out.

There are so many things to think about on a production system
that could affect many systems/third-parties because you failed
to put a check in place. Then there is of course the question
as to where is the correct place for the checks?

