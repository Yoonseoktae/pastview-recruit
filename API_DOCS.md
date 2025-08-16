# API Documentation

## Base Information

| | |
|---|---|
| **Base URL** | `https://pastview-recruit-production.up.railway.app` |
| **Content-Type** | `application/json` |
| **Accept** | `application/json` |

---

## 📌 Posts API

### **GET** `/api/posts`
> 게시글 목록을 조회합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| page | integer | No | 페이지 번호 (기본값: 1) |
| per_page | integer | No | 페이지당 항목 수 (기본값: 10) |
| search | string | No | 검색어 (제목, 내용, 작성자) |

**Response** `200 OK`
```json
{
    "message": "게시글 목록",
    "data": [
        {
            "id": 9,
            "title": "API 테스트-제목",
            "content": "API 테스트-내용",
            "author": "API 테스트-작성자",
            "is_delete": 0,
            "created_at": "2025-08-16 06:16:27",
            "updated_at": "2025-08-16 06:16:27"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 7,
        "from": 1,
        "to": 7
    }
}
```

---

### **GET** `/api/posts/{id}`
> 특정 게시글을 조회합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 게시글 ID |

**Response** `200 OK`
```json
{
    "message": "게시글 조회 완료",
    "data": {
        "id": 7,
        "title": "API 수정 테스트-제목",
        "content": "API 수정 테스트-내용",
        "author": "API 수정 테스트-작성자",
        "is_delete": 1,
        "created_at": "2025-08-15 19:47:13",
        "updated_at": "2025-08-16 05:40:55"
    }
}
```

---

### **POST** `/api/posts`
> 새로운 게시글을 생성합니다.

**Request Body**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| title | string | Yes | 게시글 제목 (최대 255자) |
| content | text | Yes | 게시글 내용 |
| author | string | Yes | 작성자 (최대 100자) |

**Example Request**
```json
{
    "title":"API 테스트-제목",
    "content":"API 테스트-내용",
    "author":"API 테스트-작성자"
}
```

**Response** `201 Created`
```json
{
    "message": "게시글 추가 완료",
    "data": {
        "is_delete": 0,
        "title": "API 테스트-제목",
        "content": "API 테스트-내용",
        "author": "API 테스트-작성자",
        "updated_at": "2025-08-16 07:41:13",
        "created_at": "2025-08-16 07:41:13",
        "id": 10
    }
}
```

---

### **PUT** `/api/posts/{id}`
> 기존 게시글을 수정합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 게시글 ID |

**Request Body**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| title | string | No | 게시글 제목 |
| content | text | No | 게시글 내용 |
| author | string | No | 작성자 |

**Example Request**
```json
{
    "title":"API 수정 테스트-제목",
    "content":"API 수정 테스트-내용",
    "author":"API 수정 테스트-작성자"
}
```

**Response** `200 OK`
```json
{
    "message": "게시글 수정 완료",
    "data": {
        "id": 7,
        "title": "API 수정 테스트-제목",
        "content": "API 수정 테스트-내용",
        "author": "API 수정 테스트-작성자",
        "is_delete": 1,
        "created_at": "2025-08-15 19:47:13",
        "updated_at": "2025-08-16 05:40:55"
    }
}
```

---

### **DELETE** `/api/posts/{id}`
> 게시글을 삭제합니다. (Soft Delete)

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 게시글 ID |

**Response** `200 OK`
```json
{
    "message": "게시글 삭제 완료"
}
```

---

### **GET** `/api/posts/{id}/comments`
> 특정 게시글의 댓글 목록을 조회합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 게시글 ID |
| per_page | integer | No | 페이지당 항목 수 (기본값: 10) |
| sort_order | string | No | 정렬 순서 (asc/desc, 기본값: asc) |

**Response** `200 OK`
```json
{
    "message": "'게시글 테스트-제목1' 댓글 목록",
    "data": [
        {
            "id": 9,
            "post_id": 1,
            "content": "API 테스트-내용",
            "author": "API 관리자",
            "is_delete": 0,
            "created_at": "2025-08-16 06:16:23",
            "updated_at": "2025-08-16 06:16:23",
            "post_title": "게시글 테스트-제목1",
            "post_author": "아무개1"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 1,
        "from": 1,
        "to": 1
    }
}
```

---

## 💬 Comments API

### **GET** `/comments`
> 댓글 목록을 조회합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| page | integer | No | 페이지 번호 (기본값: 1) |
| per_page | integer | No | 페이지당 항목 수 (기본값: 15) |

**Response** `200 OK`
```json
{
    "message": "댓글 목록 조회 완료",
    "data": [
        {
            "id": 9,
            "post_id": 1,
            "content": "API 테스트-내용",
            "author": "API 관리자",
            "is_delete": 0,
            "created_at": "2025-08-16 06:16:23",
            "updated_at": "2025-08-16 06:16:23"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 15,
        "total": 7,
        "from": 1,
        "to": 7
    }
}
```

---

### **GET** `/comments/{id}`
> 특정 댓글을 조회합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 댓글 ID |

**Response** `200 OK`
```json
{
    "message": "댓글 조회 완료",
    "data": {
        "id": 1,
        "post_id": 1,
        "content": "API 테스트-내용",
        "author": "API 관리자",
        "is_delete": 1,
        "created_at": "2025-08-15 03:17:45",
        "updated_at": "2025-08-16 06:17:52"
    }
}
```

---

### **POST** `/comments`
> 새로운 댓글을 생성합니다.

**Request Body**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| post_id | integer | Yes | 게시글 ID |
| content | text | Yes | 댓글 내용 (최대 1000자) |
| author | string | Yes | 작성자 (최대 100자) |

**Example Request**
```json
{
    "post_id": 1,
    "content": "API 테스트-내용",
    "author": "API 관리자"
}
```

**Response** `201 Created`
```json
{
    "message": "댓글 생성 완료",
    "data": {
        "is_delete": 0,
        "post_id": 1,
        "content": "API 테스트-내용",
        "author": "API 관리자",
        "updated_at": "2025-08-16 07:53:25",
        "created_at": "2025-08-16 07:53:25",
        "id": 11
    }
}
```

---

### **PUT** `/comments/{id}`
> 기존 댓글을 수정합니다.

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 댓글 ID |

**Request Body**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| content | text | No | 댓글 내용 |
| author | string | No | 작성자 |

**Example Request**
```json
{
    "post_id": 1,
    "content": "API 테스트-내용",
    "author": "API 관리자"
}
```

**Response** `200 OK`
```json
{
    "message": "댓글 수정 완료",
    "data": {
        "id": 1,
        "post_id": 1,
        "content": "API 테스트-내용",
        "author": "API 관리자",
        "is_delete": 1,
        "created_at": "2025-08-15 03:17:45",
        "updated_at": "2025-08-16 06:17:52"
    }
}
```

---

### **DELETE** `/comments/{id}`
> 댓글을 삭제합니다. (Soft Delete)

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| id | integer | Yes | 댓글 ID |

**Response** `200 OK`
```json
{
    "message": "댓글 삭제 완료"
}
```

---

## 🔴 Error Responses

### **400 Bad Request**
> 잘못된 요청 파라미터

```json
{
    "message": "제목을 입력해주세요. (and 2 more errors)",
    "errors": {
        "title": [
            "제목을 입력해주세요."
        ],
        "content": [
            "내용을 입력해주세요."
        ],
        "author": [
            "작성자를 입력해주세요."
        ]
    }
}
```

### **404 Not Found**
> 리소스를 찾을 수 없음

```json
{
    "message": "게시글을 찾을 수 없습니다.",
}
```
