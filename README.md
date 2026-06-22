### Vulnerable Web App with Vanilla PHP: Core Web Vulnerabilities & Secure Patches

This project is a vulnerable web application built with Vanilla PHP, originally created to practice and test web vulnerabilities while studying for the OSCP.

It includes both vulnerable code and its corresponding secure patches for comparison. By setting up a 2-VM environment (Kali Linux and a target Linux server), you can simulate real-world attacks from Kali to test critical impacts like Remote Code Execution (RCE), Reverse Shells, and Web Shells etc. The unused folders and files are only for Gobuster testing, can be ignored.

To ensure maximum readability, the codebase is kept simple and minimal using pure Vanilla PHP without any complex frameworks.

#### Environment

- **PHP:** 8.5.4

- **Frontend:** Bootstrap 5.3.x

- **DB:** MariaDB 11.8.6
- **DB connection:** Configure database connection in `db.php`

- **DB DDL:**

    - CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci




#### Implemented Vulnerabilities & Scenarios

##### 1. SQL Injection (SQLi)

- **Vulnerable (`v1`):** Dynamic string concatenation in `mysqli_query()` allowing authentication bypass and data exfiltration.
- **Secure Patch (`v2`):** Mitigated using **PDO with Prepared Statements** and parameterized queries.

##### 2. Remote Code Execution (RCE) via Command Injection

- **Vulnerable (`v1`):** Insecure use of system-level execution functions (`system()`, `shell_exec()`) without input sanitization.
- **Secure Patch (`v2`):** Replaced with strict argument whitelisting and proper argument escaping.

##### 3. Unrestricted File Upload (Reverse Shell)

- **Vulnerable (`v1`):** Missing extension and MIME-type validation, storing files in an executable directory.
- **Secure Patch (`v2`):** Implemented strict file extension/MIME-type validation, file renaming (`bin2hex(random_bytes)`), and disabling execution permissions in the upload directory.