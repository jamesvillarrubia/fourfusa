
#!/bin/bash


#Edit the following lines to your instance
myloc="$HOME/MAMP_Root/fourfusa"
mymysqldump="/Applications/MAMP/Library/bin"
mymysql="/Applications/MAMP/Library/bin"


# bash Colors
Color_Off='\033[0m'       # Text Reset
Black='\033[30;1m'        # Black
Red='\033[31;1m'          # Red
Green='\033[32;1m'        # Green
Yellow='\033[33;1m'       # Yellow
Blue='\033[34;1m'         # Blue
Purple='\033[35;1m'       # Purple
Cyan='\033[36;1m'         # Cyan
White='\033[37;1m'        # White

local_db="ffs_db"
env="local"
version="0.0.1"

#Add the following lines to your bash_profile
# demdep(){
#	cd $HOME/path/to/folder
#	bash demdep.sh $1 $2 $3 $4
# }
# 

cd $myloc

if [ "$1" == "compress" ]; then
	
	gulp watch
	echo ''

elif [[ "$1" == "compress"  &&  "$2" == "prod" ]]; then	

	gulp --production

elif [ "$1" == "backup" ]; then	

	${mymysqldump}/mysqldump -h localhost -u root -proot ${local_db} --complete-insert --replace --no-create-info  > $myloc/backups/${env}_backup_${version}.sql


elif [ "$1" == "help" ]; then	
	echo "\033[32;1m  *	demdep dump local db            - Dumps local db tables (according to blacklist) into /db/*.sql files\033[0m"
	echo "\033[32;1m  *	demdep pull to local            - Pulls production content tables to local \033[0m"
	echo "\033[32;1m  *	demdep pull to staging          - Pulls production content tables to stage \033[0m"
	echo "\033[32;1m  *	demdep grunt                    - Starts your local instance of grunt \033[0m"
	echo "\033[32;1m  *	demdep backup staging [vX.X.X] 	- Builds a DB backup of your staging environment \033[0m"
	echo "\033[32;1m  *	demdep backup local             - Builds a DB backup of your local environment \033[0m"
	echo "\033[32;1m  *	demdep backup production[vX.X.X]- Builds a DB backup of your production environment \033[0m"
	echo "\033[32;1m  *	demdep deploy to staging        - Capistrano deploys master branch to staging environment \033[0m"
	echo "\033[32;1m  *	demdep read into local          - Runs the sql files in the db folder locally to add admin settings back in \033[0m"	
	echo "\033[32;1m  *	                                - Fires a Jenkins test and will only commit if test on master is correct \033[0m"
	echo "\033[32;1m  *	demdep deploy to production     - NOT FUNCTIONING \033[0m"
	echo "\033[32;1m  *	demdep help                     - Lists all the commands \033[0m"

elif [ "$1" == "chuck" ]; then

	 echo ''
else 
	echo "\033[31;1m**** That is not a known command! \033[0m"
	echo "\033[31;1m**** Use \"demdep help\" to see more commands.  \033[0m"
fi


