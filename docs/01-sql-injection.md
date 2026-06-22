### SQL Injection

#### Vulnerable Version

Location: `v1-vulnerable/01-sign-in-vulnerable.php`

Attack Example

- ' OR '1'='1

#### Secure Version

Location: `v2-secure/01-sign-in-vulnerable.php`

##### Mitigation

- Prepared Statements
- Parameterized Queries
- Password Hashing