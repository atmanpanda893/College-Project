
-- Database: job_portal
CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  email VARCHAR(150) UNIQUE,
  phone VARCHAR(30),
  password VARCHAR(255),
  role VARCHAR(30),
  skills TEXT,
  resume VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  required_skills TEXT,
  location VARCHAR(150),
  salary VARCHAR(80),
  type VARCHAR(40),
  employer_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (employer_id) REFERENCES users(id) ON DELETE SET NULL
);
CREATE TABLE IF NOT EXISTS applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  job_id INT,
  status VARCHAR(80),
  applied_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);
-- Demo employer
INSERT INTO users (name,email,phone,role,created_at) VALUES ('Demo Employer','employer@example.com','+919999999999','employer',NOW());
