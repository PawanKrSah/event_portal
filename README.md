this is a portal for students to view upcoming events, guest lectures and workshops and they can register themselves.


To run this new device is completely blank, we need to install the essential development tools first, including Git, so the computer knows how to "talk" to GitHub.

Here is the complete, step-by-step procedure to clone and run your ADBU Student Event portal from GitHub on a new system.

 Phase 1: Install the Required Software
We need to download and install these four tools on the new device before downloading any code.

1. Git: Download and install Git. This allows you to clone the repository directly from the command line.
2. XAMPP/WAMPSERVER: Download and install XAMPP. This provides your local PHP server and MySQL database. Open the XAMPP Control Panel and click "Start" next to both Apache and MySQL.
3. Composer: Download and install Composer. *(During installation, it will ask for your PHP executable path. It is usually located at `C:\xampp\php\php.exe`)*.
4. Node.js: Download and install the LTS version of Node.js. This is required to compile your Tailwind CSS.

 Phase 2: Clone the GitHub Repository
Now we will pull the exact code from your GitHub account.

1. Open your computer's terminal (Command Prompt, PowerShell, or Git Bash).
2. Navigate to the folder where you want to save the project (e.g., `cd Desktop`).
3. Run the clone command using your specific GitHub repository URL:
   ```bash
   git clone https://github.com/PawanKrSah/event_portal.git
   ```
4. Once it finishes downloading, navigate *into* the newly created project folder:
   ```bash
   cd event_portal
   ```


 Phase 3: Setup the Environment File
GitHub intentionally ignores the `.env` file because it contains sensitive passwords. We have to recreate it on the new machine.

1. Inside your project folder, locate the file named `.env.example`.
2. Duplicate that file and rename the copy to exactly `.env`.
3. Open the `.env` file in your code editor and update the database credentials so they are ready for the next step:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=adbu_events
   DB_USERNAME=root
   DB_PASSWORD=
   ```

 Phase 4: Import or create Your Database


1. Make sure Apache and MySQL are running in your XAMPP Control Panel.
2. Open your web browser and go to `http://localhost/phpmyadmin`.
3. Click New on the left side to create a database and name it exactly what you put in your `.env` file (e.g., `adbu_events`).
4. Click on the new database, select the Import tab at the top, choose your provided `.sql` file, and click Import at the bottom.

 Phase 5: Install Dependencies & Run
Now we just need to tell Composer and Node.js to download all the hidden framework files that GitHub didn't include. 

Run these commands one by one in your terminal (make sure you are still inside your project folder!):

1. Install Laravel's backend packages:
   ```bash
   composer install
   ```
2. Install frontend packages:
   ```bash
   npm install
   ```
3. Generate your Application Security Key:
   ```bash
   php artisan key:generate
   ```
4. Compile your Tailwind CSS:
   ```bash
   npm run build
   ```
5. Start the local development server:
   ```bash
   php artisan serve
   ```

Open your browser and navigate to `http://127.0.0.1:8000`. Your ADBU Student Event portal will be perfectly cloned, connected to your database, and fully operational!

To login as a super admin the email "admin@event.com" password is "admin@123"


 
# student_event
