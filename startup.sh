#!/bin/bash -e
install=$1
#access a ec2-user
sudo su ec2-user
if [[ install == 'yes' ]]
then
    #install NVM 
    curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
    source ~/.bashrc
    #install Node 16.13.2
    nvm install 16.13.2
    #install pm2
    npm install -g pm2
    #clone simple payment example
    cd /home/ec2-user/
    git clone -b fowler/cloudflarePages https://github.com/gettilled/simple-payment-example.git
fi
#change directory to simple payment
cd /home/ec2-user/simple-payment-example
git pull origin fowler/cloudflarePages
#run npm install
npm install
#restart the service via pm2
pm2 restart ecosystem.config.js
