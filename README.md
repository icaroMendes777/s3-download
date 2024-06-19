# s3-connection

<p>
This is a home-made solution for a problem i had: to keep a local copy of a aws s3 bucket.
</p>
<p>
This may be useful if your local machine is safe and you need to keep watch of what is going on in your remote environment.
</p>
<p>
A backup routine runs once a day and makes the day copy of all the files in the bucket. This is good also for regression once old versions of the backups are kept.
</p>

<h3>Setup:</h3>

<ul>
<li>Setup environment variables on .env:</li>
<li>Run composer:</li>
<li>Setup a cronjob:</li>
</ul>
