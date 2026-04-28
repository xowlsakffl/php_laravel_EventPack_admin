# EventsPack Admin

EventsPack Admin은 EventsPack 웹 솔루션의 운영 데이터를 관리하는 Laravel 관리자 콘솔입니다. 사용자 프로젝트, 사이트 템플릿, 레이아웃 조각, 기능 팩을 관리하는 백오피스이며, 실제 행사 사이트를 구성하기 위한 기본 리소스를 등록하고 운영 상태를 제어하는 역할을 맡습니다.

이 저장소는 단순한 관리자 화면 모음이 아니라, EventsPack 사용자 API와 연결되는 **운영 데이터 관리 계층**입니다. 관리자는 여기서 행사 단위 프로젝트를 만들고, 사이트에 연결될 레이아웃과 기능 팩을 조합하며, 이후 사용자용 API 또는 사이트 빌더가 이 데이터를 참조할 수 있도록 구조를 준비합니다.

## 프로젝트 개요

- 관리자 로그인 기반 운영 콘솔
- 행사 단위 프로젝트(`works`) 관리
- 프로젝트별 사이트 기본 정보(`sites`) 관리 기반
- 레이아웃 템플릿 및 상단/내비게이션/중단/하단/기타 조각 관리
- 사이트 기능 팩(`packs`) 관리
- 관리자 전용 권한(`super`) 기반 접근 제어

## 이 저장소가 맡는 역할

EventsPack 솔루션은 크게 다음과 같이 나뉩니다.

- 관리자/운영 계층: 프로젝트, 사이트, 레이아웃, 기능 팩 관리
- 사용자 인증/API 계층: 회원, 토큰, OAuth, 접근 권한 검증
- 사용자 사이트 계층: 실제 행사 웹사이트 및 외부 빌더 화면

이 저장소는 첫 번째 계층에 해당합니다. 운영자가 여기서 관리하는 프로젝트와 템플릿 구조가 사용자 API 및 실제 행사 사이트 구성의 기준 데이터가 됩니다.

## 핵심 운영 흐름

1. 관리자가 Laravel 인증을 통해 관리자 콘솔에 로그인합니다.
2. `super` 권한 미들웨어를 통과한 사용자만 `/admin/*` 관리 화면에 접근합니다.
3. 운영자는 프로젝트를 생성하고 사용자 계정과 연결합니다.
4. 사이트 구성에 사용할 레이아웃 템플릿과 섹션 조각을 등록합니다.
5. 게시판/페이지 성격의 기능 팩과 기본 경로를 관리합니다.
6. 이후 사용자 API 또는 사이트 빌더가 이 구조를 바탕으로 행사 사이트를 구성합니다.

## 주요 기능

### 1. 관리자 인증 및 권한 제어

- Laravel 기본 인증 라우트 사용
- 로그인 사용자 중 `super === 'Y'` 인 관리자만 `/admin` 하위 접근 허용
- 비권한 사용자는 `403`, 미로그인 사용자는 로그인 화면으로 리디렉션

주요 경로:

- `/login`
- `/register`
- `/admin/*`

### 2. 프로젝트 관리

- 행사 단위 프로젝트 CRUD
- 프로젝트 상태별 필터링
- 사용자 `uid` 기준 프로젝트 연결
- 프로젝트 상세에서 연관 사이트 조회

주요 경로:

- `GET /admin/works`
- `POST /admin/works`
- `POST /admin/works/uid`

### 3. 레이아웃 템플릿 관리

- 통합 레이아웃 CRUD
- 상단(`layout_tops`)
- 내비게이션(`layout_navigations`)
- 중단(`layout_middles`)
- 하단(`layout_bottoms`)
- 기타 설정(`layout_etcs`)

레이아웃은 여러 조각 리소스를 조합하는 구조이며, 이름/설명/카테고리/기본 여부/상태를 함께 관리합니다.

주요 경로:

- `GET /admin/layouts`
- `GET /admin/layout-tops`
- `GET /admin/layout-navigations`
- `GET /admin/layout-middles`
- `GET /admin/layout-bottoms`
- `GET /admin/layout-etcs`

### 4. 기능 팩 관리

- 기능 팩 CRUD
- 코드 중복 방지 validation
- 국문/영문 이름, 설명, 기본 경로 관리

현재 마이그레이션 기준으로 `packs`, `pack_board`, `pack_page` 구조가 포함되어 있어, 행사 사이트의 기능 단위를 관리하는 백오피스 성격을 확인할 수 있습니다.

주요 경로:

- `GET /admin/packs`
- `POST /admin/packs`

## 기술 스택

### Backend

![PHP](https://img.shields.io/badge/PHP-7.2.5%2B%20%7C%208.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-6.20-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Blade](https://img.shields.io/badge/Blade-Template%20Engine-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Laracasts Flash](https://img.shields.io/badge/Laracasts%20Flash-3.2-F59E0B?style=for-the-badge)
![Composer](https://img.shields.io/badge/Composer-Package%20Manager-885630?style=for-the-badge&logo=composer&logoColor=white)

### Frontend / Asset Build

`package.json` 기준:

![Laravel Mix](https://img.shields.io/badge/Laravel%20Mix-5.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Axios](https://img.shields.io/badge/Axios-0.19-5A29E4?style=for-the-badge&logo=axios&logoColor=white)
![Lodash](https://img.shields.io/badge/Lodash-4.17-3492FF?style=for-the-badge&logo=lodash&logoColor=white)
![Sass](https://img.shields.io/badge/Sass-1.15-CC6699?style=for-the-badge&logo=sass&logoColor=white)
![Sass Loader](https://img.shields.io/badge/Sass%20Loader-8.0-CC6699?style=for-the-badge)

## 프로젝트 구조

```text
app/
├── Http/
│   ├── Controllers/Admin/
│   │   ├── Work/               # 프로젝트 관리
│   │   ├── Layout/             # 레이아웃 및 섹션 관리
│   │   └── Pack/               # 기능 팩 관리
│   ├── Controllers/Auth/       # 관리자 로그인/회원 인증
│   └── Middleware/             # 인증 및 super 권한 검사
├── Layout*.php                 # 레이아웃 관련 모델
├── Pack*.php                   # 팩 관련 모델
├── Site.php                    # 사이트 모델
├── User.php                    # 관리자/사용자 모델
└── Work.php                    # 프로젝트 모델
resources/views/
├── project/                    # 프로젝트 관리 화면
├── template/layout/            # 레이아웃 관리 화면
├── template/pack/              # 팩 관리 화면
└── users/                      # 사용자 관리 화면
database/migrations/
└── 2021_01_01_000001_create_eventspack_admin_tables.php
                               # works, sites, packs, layouts, logs 생성
routes/
└── web.php                     # 관리자 콘솔 라우트
```

## 데이터 모델 관점의 특징

이 저장소의 핵심 테이블은 다음과 같습니다.

- `works`: 행사 단위 프로젝트
- `sites`: 프로젝트별 사이트 정보
- `layouts`: 조합형 레이아웃 템플릿
- `layout_tops`, `layout_navigations`, `layout_middles`, `layout_bottoms`, `layout_etcs`: 레이아웃 조각 리소스
- `packs`: 기능 팩 메타데이터
- `pack_board`, `pack_page`: 기능 팩 기반 콘텐츠 구조
- `user_action_logs`: 관리자 활동 로그

즉, 관리자 콘솔은 화면만 제공하는 것이 아니라, 행사 사이트를 조립하기 위한 템플릿/기능/운영 데이터를 직접 관리하는 저장소입니다.

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

기본 개발 서버는 `http://127.0.0.1:8000` 또는 `http://localhost:8000`에서 실행됩니다.

## 주요 환경 변수

| 변수 | 설명 |
| --- | --- |
| `APP_NAME` | 관리자 콘솔 애플리케이션 이름 |
| `APP_URL` | 관리자 콘솔 기본 URL |
| `DB_HOST` | MySQL 호스트 |
| `DB_PORT` | MySQL 포트 |
| `DB_DATABASE` | 관리자 콘솔 데이터베이스명 |
| `DB_USERNAME` | DB 계정 |
| `DB_PASSWORD` | DB 비밀번호 |
| `MAIL_DRIVER` | 메일 드라이버 |
| `MAIL_HOST` | 메일 서버 호스트 |
| `MAIL_PORT` | 메일 서버 포트 |
| `MAIL_FROM_ADDRESS` | 발신 주소 |
| `MAIL_FROM_NAME` | 발신자 이름 |

## 현재 코드 기준 참고 사항

- `/admin/*` 경로는 `auth`와 `super` 미들웨어를 모두 통과해야 접근할 수 있습니다.
- README 범위에는 사용자 관리 화면도 포함되지만, 실제 `routes/web.php` 기준 핵심 리소스는 `works`, `layouts`, `layout-*`, `packs`입니다.
- 정적 자산은 Laravel Mix로 빌드하며, `public/` 아래에 직접 포함된 프런트 스크립트도 일부 존재합니다.
- 따라서 이 저장소는 범용 관리자 템플릿이 아니라, **EventsPack 운영 데이터와 사이트 구성 리소스를 관리하는 전용 백오피스**로 소개하는 편이 정확합니다.

## 보완한 부분

- 누락된 `artisan`, `bootstrap/`, `storage/`, `server.php`, `webpack.mix.js` 복구
- `.env.example`, `.gitignore`, `.gitattributes` 추가
- Composer/NPM 메타데이터를 프로젝트명 기준으로 정리
- 기본 시간대와 locale를 국내 서비스 기준으로 정리
- `CheckSuper` 미들웨어가 아무 것도 반환하지 않던 문제 수정
- `/admin` 하위 라우트에 관리자 권한 미들웨어 적용
- 없는 레코드 접근 시 null 오류 대신 `404` 처리
- 레이아웃 하위 리소스의 잘못된 unique table 검증 수정
- 수정 화면에서 자기 자신의 code 값 때문에 validation이 실패하던 문제 수정
- `LayoutMiddleController`에 남아 있던 깨진 코드 조각 제거
- 모델 관계 오류 수정
- 모델 구조에 맞는 통합 migration 추가

## 관련 저장소

- 사용자 API: `php_laravel_EventsPack_dev1`
- 관리자: `php_laravel_EventPack_admin`
