라라벨 사전과제 안내
주제: 게시판 API 개발
목적: 라라벨 CRUD 기본기, DB 모델링, API 문서 작성 능력 확인

1. 환경정보
- Backend: Laravel 12.2, PHP 8.3
- Database: MySQL 9.4 (Railway)
- ORM: Eloquent
- Deploy + Online: Railway
- Repository: GitHub

2. 관련 URL
- [POSTMAN Collection](./postman)
- [API Documentation](./API_DOCS.md)
- local Endpoint : http://localhost:8000
- Live Endpoint: https://pastview-recruit-production.up.railway.app
- Github : https://github.com/Yoonseoktae/pastview-recruit
- Railway 
    - WEB : https://railway.com/invite/CVT7GF5O463
    - Mysql : https://railway.com/invite/kD6yHkNbPW5

3. 프로젝트 구조
<pre>
pastview-recruit/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── BaseController.php
│   │   │       ├── PostController.php
│   │   │       └── CommentController.php
│   │   └── Requests/
│   │       ├── PostRequest.php
│   │       └── CommentRequest.php
│   └── Models/
│       ├── Post.php
│       └── Comment.php
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── web.php
├── .env.example
├── composer.json
├── railway.json
└── README.md
</pre>

4. 실행방법
```bash

- LIVE
# 1. PostMan Collection Test.

- LOCAL
# 1. 프로젝트 클론
git clone https://github.com/Yoonseoktae/pastview-recruit.git
cd pastview-recruit

# 2. 의존성 설치
composer install

# 3. 라라벨 환경 설정
cp .env.example .env
php artisan key:generate

# 5. 마이그레이션 실행
php artisan migrate

# 6. 시더 실행 (테스트 데이터)
php artisan db:seed

# 7. 서버 실행
php artisan serve

# 8. PostMan Collection Test.
```

5. 작업 세부 히스토리
- 공통
    1. Github 저장소 추가 (pastview-recruit)
- Railway
    1. Github 계정 로그인
    2. 프로젝트 생성 + github 저장소 연결
    3. railway.json을 통해 배포 연동 설정.
    4. Mysql 생성 (9.4)
    5. 환경변수 동기화
    6. public 도메인 발급
    7. 자동 배포 및 도메인 확인
- 로컬
    1. PHP 다운로드 (8.3 x64 Thread Safe)
    2. php.ini에서 필요한 확장 모듈 활성화:
        - curl, fileinfo, gd, mbstring, openssl, pdo_mysql, zip, sodium, bcmath
    3. composer 설치
    4. Git 설치 (main/dev 브랜치 생성)
    5. Laravel 설치  (12)
    6. Git 저장소 연동.
    7. 라라벨 서버 실행
    8. 마이그레이션/시더 생성 및 실행
    9. CRUD REST API 작업
        - API 컨트롤러 생성 및 라우팅 확인
        - 유효성 검사 클래스 생성 
        - Request 클래스 생성
        - REST API 작업 + PostMan API 테스트 진행
        - Postman Collection Export
    10. README 정리.
    
        

