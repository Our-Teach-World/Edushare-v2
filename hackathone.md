# EduShare - Smart Educational File Sharing Platform

> **Hackathon Link:** [Insert Hackathon Submission Link Here]  
> **Repository:** [Insert GitHub Repo Link Here]

## 🚀 Project Overview
**EduShare** is an innovative web-based platform designed to bridge the gap between educators and students by providing a secure, efficient, and AI-powered environment for sharing educational resources. In today's digital learning landscape, fragmented communication channels often lead to lost materials and disorganized workflows. EduShare solves this by centralizing file management, ensuring that students have seamless access to study materials uploaded by their verified teachers.

Unlike traditional file storage, EduShare is tailored for education with role-based access, organized categorization, and an integrated **AI Chatbot** to assist students in real-time.

## 👥 Team Members
*   **Ashish Meghwal** - Team Leader & Full Stack Developer
*   **Komal Panchal** - Backend & AI Integration Specialist
*   **Bhumika Rathore** - Frontend Designer & UI/UX

## ✨ Key Features

### 1. Dual-Role Architecture
*   **Teacher Dashboard:** A dedicated interface for educators to upload, manage, and categorize files (PDFs, Images, Videos, Audio) by subject and class.
*   **Student Dashboard:** A simplified view for students to browse, search, and download resources uploaded by their specific teachers.

### 2. Smart File Management
*   **Automated Organization:** Files are automatically sorted into type-specific folders (e.g., PDFs in one folder, Images in another) to keep the repository clean.
*   **Secure Access:** Role-based permissions ensure that only authorized users can upload or access sensitive content.

### 3. 🤖 AI-Powered Assistance (Gemini API)
*   **Intelligent Chatbot:** Integrated with Google's Gemini API, the chatbot serves as a 24/7 study companion.
*   **Context-Aware Help:** Students can ask questions related to their subjects, and the AI provides instant, accurate explanations.
*   **Audio Response:** The chatbot can read out its responses aloud, making learning accessible and interactive through voice.
*   **PDF Generation:** The chat interface allows users to export AI conversations as PDF notes for offline study.

### 4. Modern & Responsive UI
*   **Neon Aesthetics:** A visually striking dark-mode design with neon accents to appeal to modern users.
*   **Mobile-First Approach:** Fully responsive layout ensuring accessibility on smartphones, tablets, and desktops.

## 🛠️ Tech Stack

*   **Frontend:** HTML5, CSS3 (Custom Neon Design), JavaScript (Vanilla)
*   **Libraries:** Font Awesome (Icons)
*   **Backend:** PHP (Core)
*   **Database:** MySQL (Stores user data, file metadata, and chat logs)
*   **File Processing:** 
    *   **PDF Extraction:** Smalot PDF Parser (Extracts text for AI analysis)
    *   **Image & File Storage:** Local Server Filesystem (Structured directory system)
*   **AI Integration:** Google Gemini API (Generative AI)
*   **Tools:** VS Code, XAMPP (Apache Server), Composer (Dependency Manager)

## 🔄 How It Works
1.  **Registration:** Users sign up as either a Teacher or a Student.
2.  **Authentication:** Secure login redirects users to their respective dashboards.
3.  **Upload (Teacher):** Teachers upload study materials, which are stored securely on the server and indexed in the database.
4.  **Access (Student):** Students log in, view their teachers' uploads, and download materials.
5.  **AI Support:** Students can toggle the AI chat widget to get instant help with complex topics while studying.

## 🔮 Future Scope
*   **Real-time Collaboration:** Enabling live document editing between students and teachers.
*   **Advanced Analytics:** Providing teachers with insights on which resources are most downloaded.
*   **Mobile App:** Developing a native application for Android and iOS.
*   **Google reCAPTCHA:** Implementing CAPTCHA verification to enhance security against bots and spam.

---
*Built with ❤️ for [Hackathon Name]*
