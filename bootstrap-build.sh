echo "Building bootstrap..."

rm -rf app/cache/bootstrap
cp -r vendor/twitter/bootstrap app/cache/bootstrap

cd app/cache/bootstrap
npm install > /dev/null 2>&1
make bootstrap > /dev/null 2>&1
cd ../../..

rm -rf source/bootstrap
cp -r app/cache/bootstrap/bootstrap source/bootstrap