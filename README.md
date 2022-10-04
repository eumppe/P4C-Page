메일 인증을 위한 sendmail 사용을 위해, ubuntu를 이용해 실행시켜야 합니다.
<h3>ubuntu setup</h3>
php 설치
apt install php

mysqli.so 설치
sudo apt-get install php-mysql

php.ini 설정
경로: /etc/php/\<version\>/cli
;exension=mysqli
에서 ;를 지워서 주석처리를 취소하기.
extension_dir="ext"
에서 "ext"의 내용을
php-config --extension-dir
위 명령어 입력해서 나오는 디렉토리로 바꾸기 

root 계정의 비밀번호는 시스템 환경변수에 'MySQLrootPW'라는 이름으로 저장해두셔야 합니다.
환경변수 설정하는 명령어
export variableName=value
(비밀번호는 문자열이므로 value를 따옴표로 감싸야 함.)

메일 인증을 정상적으로 하기 위해서는 php mail()함수를 쓰기 위한 몇가지 설정이 필요합니다.
ubuntu에서는 sendmail을 설치해야 합니다.

<h3>PHP 서버 실행시키는 법</h3>
1. ubuntu 터미널을 열어서
2. 경로를 프로젝트 폴더로 옮기고
3. php -S localhost:\<port\>
(아파치는 쓰지 않습니다.)

mySQL 서버 포트는 기본값 3306을 사용합니다.

verify-email.php에 사이트 주소를 넣는 곳이 있습니다.
로컬호스트가 아닌 다른 서버에서 돌릴 때는 수정해야 합니다.