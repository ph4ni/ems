# PHP-based End-to-end Event Management System

## 🚀 Features

* **Create Events**: Create and manage multiple events from the dashboard. 
* **Generate Forms**: Generate sign up forms based on requirements and share them to participants.
* **Manage Data**: No need of juggling between csv, excel, and other files. Manage all submission data at one place.
* **QR Attendance**: QR Codes are automatically generated and sent to users after their form has been submitted. Take attendances from Laptop/phone camers by simply scanning their QR codes!
* **Multiple Sessions**: Organising multiple sessions in a single event? Create as many sessions as you like per event. Attendance data will be different between each session.
* **Generate Certificates**: Check eligibility and generate certificates automatically for all eligible participants. (in progress)

## 📸 Screenshots
![image](https://github.com/ph4ni/ems/assets/29685411/782874b0-1e94-479b-93c5-ea1fe04fef1a)
![image](https://github.com/ph4ni/ems/assets/29685411/702b28db-1d9c-4b40-b4e7-938ebbd8e89a)
![image](https://github.com/ph4ni/ems/assets/29685411/5b0ebec4-2228-40d8-9021-27f23958bd3a)
![image](https://github.com/ph4ni/ems/assets/29685411/57b9fee0-b147-4dc1-8c23-8181e48db35f)
![image](https://github.com/ph4ni/ems/assets/29685411/b0f0e25d-96fa-4ffa-8f6c-228139dc9bf9)

## 🏗️ Development aka behind the scenes
This project has been developed using the LAMP/XAMPP/WAMP stack with some JS here and there. Since it deals with dynamically generated html forms, PHP code and the MySQL queries accompanying it, it dwells into a fair bit of complexity. The code is not pretty to look at and refactoring is in the roadmap.<br><br>
**References:**<br>
PHP Registration + Login system: [codeshack.io/secure-registration-system-php-mysql](https://codeshack.io/secure-registration-system-php-mysql/)<br>
QR Code Generator: [github.com/t0k4rt/phpqrcode](https://github.com/t0k4rt/phpqrcode).<br>
Certificate Generator With PHP Using imagettftext function: [dev.to/olawanle_joel/certificate-generator-with-php-using-imagettftext-function-1glh](https://dev.to/olawanle_joel/certificate-generator-with-php-using-imagettftext-function-1glh).

## 🤝 Contributing
Some tasks you can take up
* Refactoring the codebase. Can follow [Clean Code for PHP](https://github.com/piotrplenik/clean-code-php).
* Implementing email alerts and confirmations.
* Event-specific certificate elgibility rules and policies generation.
* Multi-access to the admin dashboard so that volunteers can work together.
* Host a demo of this project.
* And whatever ideas you have, you can use the issues or discussion page of this repo.
