**User Routes**:-

| Method | Endpoint       | Description |
| :----  | :----          | :---- |
| GET    | /              | Homepage For user |
| GET    | /nearby-stores | Get list of nearby stores |

**Admin Store Management**:-

| Method | Endpoint                | Description |
| :----  | :----                   | :---- |
| GET    | /admin/stores           | List all stores |
| GET    | /admin/stores/create    | Show form to create a store |
| POST   | /admin/stores           | Store new store details |
| GET    | /admin/stores/edit/{id} | Edit a specific store |
| PUT    | /admin/stores/{id}      | Update store details |
| DELETE | /admin/stores/{id}      | Delete a store |

**Authentication Routes**:-

| Method | Endpoint     | Description |
| :----  | :----        | :---- |
| GET    | /admin/login | Show login page |
| POST   | /admin/login | Authenticate admin login |
| POST   | /logout      | Logout the user |

