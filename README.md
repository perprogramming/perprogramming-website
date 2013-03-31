perprogramming.github.com
=========================

This repository contains everything required to generate the sources of my website http://perprogramming.de.

```bash
git clone https://github.com/perprogramming/perprogramming-website.git
cd perprogramming-website
curl -sS https://getcomposer.org/installer | php
./composer.phar install
echo "parameters:
    secret: someSecret
    output.dir: /tmp/
" > app/config/parameters.yml
vendor/bin/sculpin generate --server
```

After that you should be able to open the website with http://127.0.0.1:8000.

The definition of the website is in the subdirectory "source".