# Student Grades Frontend

A React + Vite interface for the Student Grades Management System.

## Run locally

From this directory:

```bash
npm install
npm run dev
```

Open the local URL printed by Vite. To create a production build, run `npm run build`.

## Demo roles and data

Use the **Demo role** selector to preview the Admin, Teacher, and Student screens. The Teacher preview is limited to sample Mathematics and Physics classes; the Student preview shows one sample student's records. These are front-end demonstrations only, not authenticated or secure role controls.

The interface uses sample data stored in React state. Adding a grade updates the current page only; it does not persist after a refresh or connect to the Laravel database. The Laravel application currently renders its own Blade pages and does not expose a JSON API.
