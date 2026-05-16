# git-ci-cd-project

PHP, Apache, MySQL을 Docker Compose로 실행하는 회원 관리 프로젝트입니다.

## 프로젝트 구성

- `web`: PHP 8.2 + Apache 웹 서버
- `db`: MySQL 8.0 데이터베이스
- `docker-compose.yml`: 웹 서버와 MySQL을 함께 실행하고 연결합니다.
- `DockerFile`: PHP 웹 애플리케이션 이미지를 빌드합니다.

## 실행 방법

먼저 환경 변수 파일을 생성합니다.

```bash
cp .env.example .env
```

Windows PowerShell에서는 아래 명령어를 사용할 수 있습니다.

```powershell
Copy-Item .env.example .env
```

생성한 `.env` 파일에서 `DB_PASSWORD`와 `MYSQL_ROOT_PASSWORD` 값을 원하는 비밀번호로 변경합니다. `DB_USER`를 `root`로 사용할 경우 두 비밀번호는 같은 값으로 설정합니다.

그 다음 Docker Compose를 실행합니다.

```bash
docker compose up --build -d
```

실행 후 브라우저에서 아래 주소로 접속합니다.

```text
http://localhost:8080
```

## 데이터베이스 정보

- 데이터베이스 이름: `my_site`
- 테이블 이름: `member`
- 웹 컨테이너는 `DB_HOST=db` 환경변수를 사용해 MySQL 컨테이너에 연결합니다.
- 비밀번호는 Git에 올리지 않는 `.env` 파일에서 관리합니다.

`member` 테이블은 웹 컨테이너가 시작될 때 자동으로 생성됩니다.

DB 비밀번호를 변경한 뒤 기존 볼륨 때문에 접속이 되지 않으면 아래 명령어로 기존 DB 볼륨을 삭제한 뒤 다시 실행합니다.

```bash
docker compose down -v
docker compose up --build -d
```

## Docker Hub 이미지

```text
https://hub.docker.com/r/plzbuffshen/git-ci-cd-project-web
```

## GitHub Actions

GitHub Actions를 통해 Docker Compose 설정 검증, 컨테이너 빌드 및 실행, 웹 페이지 접속, MySQL 테이블 확인을 자동으로 테스트합니다.

Docker Hub Secrets가 설정되어 있으면 테스트 성공 후 웹 이미지를 Docker Hub에 자동으로 push합니다.

- `latest`: 최신 성공 빌드
- `커밋 SHA 앞 7자리`: 특정 커밋의 빌드 이미지

GitHub 저장소의 `Settings` > `Secrets and variables` > `Actions`에서 아래 Secrets를 추가하면 자동 push가 활성화됩니다.

- `DOCKERHUB_USERNAME`: Docker Hub 사용자명
- `DOCKERHUB_TOKEN`: Docker Hub Access Token

Actions 실행 기록:

```text
https://github.com/xkqtnpsqudwk/git-ci-cd-project/actions
```

## 유용한 명령어

```bash
docker compose ps
docker compose logs web
docker compose logs db
docker compose down
```

## 종료 방법

```bash
docker compose down
```
