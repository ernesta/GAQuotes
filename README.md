# [@GAQuotesBot](http://twitter.com/GAQuotesBot)

I knew Grey's Anatomy was going to be good from the very first episode. It all starts with the series' protagonist waking up after a one-night-stand with a guy who - she later learns - is her new boss. Ouch. However, while the mix of love triangles and crazy traumas is exhilarating, its the punch lines that I love most. I've been collecting funny, insightful, and just plain weird quotes from the series for a while now, and @GAQuotesBot has been duly tweeting them - to the excitement of some 4000+ followers. This repository contains the tools that make quote collection and management quick and fun.

##Code
More precisely, _tweet_ houses a very short script that tweets a pseudo-random quote once in a while. _admin_ is the bot administration panel that makes it easy to add new quotes and edit or delete the old ones.

Both the bot and the admin panel require one additional file to work. The _secrets.php_ should be placed in the project's root directory, and define the following constants:

	define("DB_HOST", "");
	define("DB_USER", "");
	define("DB_PASSWORD", "");
	define("DB_NAME", "");
	define("DB_TABLE", "");
	
	define("CONSUMER_KEY", "");
	define("CONSUMER_SECRET", "");
	define("OAUTH_TOKEN", "");
	define("OAUTH_TOKEN_SECRET", "");

## Author
**Ernesta Orlovaitė**

+ [ernes7a.lt](http://ernes7a.lt)
+ [@ernes7a](http://twitter.com/ernes7a)