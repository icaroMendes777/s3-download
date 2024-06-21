# s3-connection

<p>
This is a home-made solution for a problem i had: to keep a local backup of a aws s3 bucket.
</p>
<p>
This may be useful if your local machine is safe and you need to keep watch of what is going on in your remote environment.
</p>
<p>
A backup routine runs once a day and makes the day copy of all the files in the bucket. This is good also for regression once old versions of the backups are kept.
</p>

<h3>Setup:</h3>

<ul>
<li>Setup environment variables on .env (we have a .env.example ready to you!). Just be sure to use absolute paths to avoid misruns</li>
<li>Run composer: "Composer install"</li>
<li>Setup a cronjob: the cronjob must run at least once a day in a time the machine is on. I suggest to run it every five minutes, once the script is automatically limited to run only once a day - set it up to run the script "download-routine.bash"</li>
<li>Have Fun!</li>
</ul>
