# EventsPack Admin

EventsPack 서비스의 운영자용 Laravel 관리자 콘솔입니다. 사용자, 프로젝트, 사이트 빌더용 레이아웃, 레이아웃 구성요소, 기능 팩을 관리하는 백오피스 프로젝트입니다.

포트폴리오 관점에서 핵심은 단순 관리자 화면이 아니라 EventsPack 사용자 API와 연결되는 운영 데이터 구조를 관리하는 점입니다. 프로젝트 단위로 사이트를 관리하고, 상단/내비게이션/중단/하단/기타 레이아웃 조각을 조합해 사이트 템플릿을 구성할 수 있습니다.

## 주요 기능

- 관리자 로그인
- 사용자/프로젝트 관리
- 프로젝트별 사이트 목록 확인
- 레이아웃 템플릿 관리
- 상단/내비게이션/중단/하단/기타 레이아웃 구성요소 CRUD
- 기능 팩 관리
- 상태값 기준 목록 필터링
- 검색 조건 기반 관리자 목록 조회

## 기술 스택

- PHP 7.2.5+
- Laravel 6.20
- MySQL
- Blade
- Laravel Mix
- Sass
- Laracasts Flash

## 프로젝트 구조

```text
app/
├── Http/Controllers/Admin/     # 관리자 CRUD 컨트롤러
├── Http/Middleware/            # 인증/관리자 권한 미들웨어
├── Layout*.php                 # 레이아웃 구성 모델
├── Pack*.php                   # 기능 팩 모델
├── Site.php
├── User.php
└── Work.php
resources/views/
├── project/                    # 프로젝트 관리 화면
├── template/layout/            # 레이아웃 관리 화면
├── template/pack/              # 기능 팩 관리 화면
└── users/
```

## 실행 준비

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

PowerShell:

```powershell
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## 주요 환경변수

| 변수 | 설명 |
| --- | --- |
| `APP_URL` | 관리자 콘솔 URL |
| `DB_DATABASE` | MySQL 데이터베이스명 |
| `DB_USERNAME` | DB 계정 |
| `DB_PASSWORD` | DB 비밀번호 |
| `MAIL_DRIVER` | Laravel 6 메일 드라이버 |

## 보완한 부분

- 누락된 `artisan`, `bootstrap/`, `storage/`, `server.php`, `webpack.mix.js` 복구
- `.env.example`, `.gitignore`, `.gitattributes` 추가
- Composer/NPM 메타데이터를 프로젝트명 기준으로 정리
- 기본 시간대와 locale을 한국 서비스 기준으로 정리
- `CheckSuper` 미들웨어가 아무 것도 반환하지 않던 문제 수정
- `/admin` 하위 라우트에 관리자 권한 미들웨어 적용
- 없는 레코드 접근 시 null 오류 대신 404 처리
- 레이아웃 하위 리소스의 잘못된 unique table 검증 수정
- 수정 화면에서 자기 자신의 code 값 때문에 validation이 실패하던 문제 수정
- `LayoutMiddleController`에 섞여 있던 깨진 코드 조각 제거
- 모델 관계 오류 수정
- 모델 구조에 맞는 핵심 migration 추가

## 관련 저장소

- 사용자 API: `php_laravel_EventsPack_dev1`
- 관리자: `php_laravel_EventPack_admin`

## 주의 사항

- 운영 DB와 실서비스 환경값은 저장소에 포함하지 않습니다.
- 최초 관리자 계정은 DB seed 또는 직접 생성이 필요합니다.
- 관리자 접근은 `users.super = 'Y'`인 계정만 허용됩니다.
- 이 프로젝트는 Laravel 6 기반이라 최신 Laravel 프로젝트와 설정 방식이 다릅니다.
