
# 📡 Medos Imitasi API – Dokumentasi Endpoint

**Base URL:** `http://127.0.0.1:8000/api/v1`

Seluruh endpoint membutuhkan autentikasi JWT **kecuali** `login` dan `register`.

---

## 🔐 Authentication

### ▶️ Login  
**POST** `/login`

**Request**
```json
{
  "email": "evosabdul@gmail.com",
  "password": "123123"
}
```

**Response**
```json
{
  "access_token": "JWT_TOKEN",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

### 🆕 Register  
**POST** `/register`

**Request**
```json
{
  "fullname": "naufal ananta",
  "email": "evosabdul@gmail.com",
  "password": "123123"
}
```

**Response**
```json
{
  "success": true,
  "message": "User registered successfully"
}
```

---

## 📄 Posts

### 📥 Get All Posts  
**GET** `/posts`  
🔒 Requires Auth

**Response**
```json
[
  {
    "id": 1,
    "content": "Hello world",
    "image_url": null,
    "created_at": "2025-07-05T12:00:00.000000Z",
    "updated_at": "2025-07-05T12:00:00.000000Z",
    "user": {
      "id": 10,
      "fullname": "Naufal"
    },
    "comments": [
      {
        "id": 5,
        "content": "Mantap!",
        "created_at": "2025-07-05T12:05:00.000000Z",
        "user": {
          "id": 12,
          "fullname": "paimon"
        }
      }
    ],
    "likes_count": 5
  }
]
```

---

### 📥 Get Post by ID  
**GET** `/posts/{id}`  
🔒 Requires Auth

---

### ➕ Create Post  
**POST** `/posts`  
🔒 Requires Auth

**Request**
```json
{
  "content": "Contoh post",
  "image_url": "https://example.com"
}
```

---

### ✏️ Update Post  
**PUT** `/posts/{id}`  
🔒 Requires Auth

**Request**
```json
{
  "content": "Edit konten",
  "image_url": "https://example.com/updated"
}
```

---

### ❌ Delete Post  
**DELETE** `/posts/{id}`  
🔒 Requires Auth

---

## 🛡️ Authorization Header

Untuk semua endpoint yang dilindungi, tambahkan header berikut:

```
Authorization: Bearer {JWT_TOKEN}
```

---
