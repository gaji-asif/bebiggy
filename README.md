**Edit a file, create a new file, and clone from Bitbucket in under 2 minutes**

When you're done, you can delete the content in this README and update the file with details for others getting started with your repository.

*We recommend that you open this README in another tab as you perform the tasks below. You can [watch our video](https://youtu.be/0ocf7u76WSo) for a full demo of all the steps in this tutorial. Open the video in a new tab to avoid leaving Bitbucket.*

---

## Edit a file

You’ll start by editing this README file to learn how to edit a file in Bitbucket.

1. Click **Source** on the left side.
2. Click the README.md link from the list of files.
3. Click the **Edit** button.
4. Delete the following text: *Delete this line to make a change to the README from Bitbucket.*
5. After making your change, click **Commit** and then **Commit** again in the dialog. The commit page will open and you’ll see the change you just made.
6. Go back to the **Source** page.

---

## Create a file

Next, you’ll add a new file to this repository.

1. Click the **New file** button at the top of the **Source** page.
2. Give the file a filename of **contributors.txt**.
3. Enter your name in the empty file space.
4. Click **Commit** and then **Commit** again in the dialog.
5. Go back to the **Source** page.

Before you move on, go ahead and explore the repository. You've already seen the **Source** page, but check out the **Commits**, **Branches**, and **Settings** pages.

---

## Clone a repository

Use these steps to clone from SourceTree, our client for using the repository command-line free. Cloning allows you to work on your files locally. If you don't yet have SourceTree, [download and install first](https://www.sourcetreeapp.com/). If you prefer to clone from the command line, see [Clone a repository](https://confluence.atlassian.com/x/4whODQ).

1. You’ll see the clone button under the **Source** heading. Click that button.
2. Now click **Check out in SourceTree**. You may need to create a SourceTree account or log in.
3. When you see the **Clone New** dialog in SourceTree, update the destination path and name if you’d like to and then click **Clone**.
4. Open the directory you just created to see your repository’s files.

Now that you're more familiar with your Bitbucket repository, go ahead and add a new file locally. You can [push your change back to Bitbucket with SourceTree](https://confluence.atlassian.com/x/iqyBMg), or you can [add, commit,](https://confluence.atlassian.com/x/8QhODQ) and [push from the command line](https://confluence.atlassian.com/x/NQ0zDQ).


## Framework Specification 
1. If Seller become sub-admin then his product can not sell , since for sell , generate contract 
it requirs user_id which will not available.
2. There no way to add sub-Admin to Seller
## Lising header Plans
1. Id's for Regular, Highlight and Premium will be set on constant.php file.
Will be Used from their only

## Default membership assign
if admin changes default membership level plan to some other plan then membership ID should change for all already assigned user and their membership cache will also clear

## Google Analytics report v4
URL : https://developers.google.com/analytics/devguides/reporting/core/v4/quickstart/service-php

To download json key
Note: When prompted click Furnish a new private key and for the Key type select JSON, and save the generated key as client_secrets.json; you will need it later in the tutorial.

1. Open the Service accounts page. If prompted, select a project.

2.Click add Create Service Account, enter a name and description for the service account. You can use the default service account ID, or choose a different, unique one. When done click Create.

3.The Service account permissions (optional) section that follows is not required. Click Continue.

4.On the Grant users access to this service account screen, scroll down to the Create key section. Click add Create key.

5.In the side panel that appears, select the format for your key: JSON is recommended.

6.Click Create. Your new public/private key pair is generated and downloaded to your machine; it serves as the only copy of this key. For information on how to store it securely, see Managing service account keys.

7.Click Close on the Private key saved to your computer dialog, then click Done to return to the table of your service accounts.

## Mysql ONLY_FULL_GROUP_BY error solution.

expression #8 of select list is not in group by clause and contains nonaggregated column

msyql version is 5.7.22
Run following command to fix this errors.

1. sudo nano /etc/mysql/my.cnf
2. Add at last 
        [mysqld]
        sql_mode = STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION
3. sudo service mysql restart
4. sudo service apache2 restart

## Step to for payment 

1. In Payment controller 

First  Stripe_int method is called
if sponsor data is present then collect data - from txt_sponsored_id
then collect list header plan data
then collect card details
then call direct_payments method 
after payment done...
direct_payments method -> we call InsertDomainPurchaseData method which will create invoices
add the plan header addPlanHeaderIntoListing with this header ( regular, hightlited, premium)
redirect to success page.






