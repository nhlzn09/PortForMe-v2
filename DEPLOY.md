# Publish PortForMe online (Render + Aiven MySQL)

Two free services: **Aiven** keeps the MySQL database online, **Render** runs the website and gives you a public
link such as `https://portforme.onrender.com`. Both need an account (no credit card for the free plans as of
October 2026, but check their pages if this has changed).

## 1. Online database: Aiven for MySQL (free plan)
1. Sign up at aiven.io and create a service: **MySQL**, plan **Free**, any region. Wait until it shows **Running**.
2. Open the service **Overview** and write down: **Host**, **Port**, **User** (`avnadmin`), **Password**, and
   **Database name** (`defaultdb`).
3. On the same page click **Download** next to **CA certificate** and open the file in Notepad. You'll paste it later.
4. Aiven may switch off a free service that is unused for a while. If the site stops working, open the service and
   power it back on.

## 2. Put the code on GitHub
Your repo is already at github.com/nhlzn09/PortForMe. Copy the files from this package into it (same folders),
commit and push. Never upload `.env`.

## 3. Website: Render
1. At render.com choose **New > Web Service** and connect your GitHub repo.
2. Language: **Docker**. Instance type: **Free**. Render finds the `Dockerfile` by itself.
3. Under **Environment Variables** add:

| Name | Value |
|---|---|
| `APP_NAME` | `PortForMe` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | output of `php artisan key:generate --show` (run it in your Codespace or computer) |
| `APP_URL` | your Render address, for example `https://portforme.onrender.com` |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | Host from Aiven |
| `DB_PORT` | Port from Aiven |
| `DB_DATABASE` | `defaultdb` |
| `DB_USERNAME` | `avnadmin` |
| `DB_PASSWORD` | Password from Aiven |
| `DB_SSL_CA_PEM` | the whole text of the CA certificate, including the BEGIN and END lines |
| `LOG_CHANNEL` | `stderr` |

4. Click **Create Web Service**. The first build takes a few minutes. On every start the site creates the tables
   by itself (`php artisan migrate`).
5. Open your Render address. The free plan sleeps after about 15 minutes without visitors, so the first load can
   take up to a minute. Open it once before your instructor does.

If you prefer not to paste the certificate as a variable, save it as `certs/ca.pem` in the repo instead. The CA
certificate is public, not a secret.

## 4. Test it like the instructor will
1. Open the URL, sign up, click **Create Portfolio**.
2. Fill in the form, add a profile picture and a project picture, click **Save and choose a template**.
3. Try all 3 templates, choose one, check the preview.
4. **Manage** > **Edit information**, change something, save. Refresh the page: the change is still there.
5. **Manage** > **Delete**, confirm. The portfolio is gone.

## 5. Show that data is in the online database
Connect to the Aiven database with MySQL Workbench, DBeaver or HeidiSQL using the Host, Port, User, Password and
the CA certificate from step 1. You will see the tables `users`, `portfolios`, `educations`, `skills`, `projects`,
`experiences` and `social_links`. Take a screenshot of a `portfolios` row for your documentation.
Do not put the password in your documentation or source code.
