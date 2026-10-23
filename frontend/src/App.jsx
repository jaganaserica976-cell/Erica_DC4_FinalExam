import { useMemo, useState } from 'react';

const startingGrades = [
  { id: 1, studentId: 'STU-001', name: 'Samantha Lee', subject: 'Mathematics', prelim: 92, midterm: 88, final: 94 },
  { id: 2, studentId: 'STU-002', name: 'Noah Williams', subject: 'English', prelim: 78, midterm: 82, final: 85 },
  { id: 3, studentId: 'STU-003', name: 'Olivia Chen', subject: 'Biology', prelim: 96, midterm: 94, final: 98 },
  { id: 4, studentId: 'STU-004', name: 'Ethan Rivera', subject: 'Mathematics', prelim: 68, midterm: 72, final: 70 },
  { id: 5, studentId: 'STU-005', name: 'Ava Thompson', subject: 'Physics', prelim: 88, midterm: 91, final: 89 },
  { id: 6, studentId: 'STU-006', name: 'Liam Patel', subject: 'English', prelim: 73, midterm: 76, final: 79 },
];

const subjects = ['Mathematics', 'English', 'Biology', 'Physics'];
const teacherSubjects = ['Mathematics', 'Physics'];
const demoStudentId = 'STU-001';

function getNavigation(role) {
  if (role === 'Teacher') return ['Dashboard', 'Classes', 'Grades'];
  if (role === 'Student') return ['Dashboard', 'Academic Records'];
  return ['Dashboard', 'Students', 'Teachers', 'Subjects', 'Classes', 'Grades', 'Reports'];
}

function getAverage(grade) {
  return Math.round((grade.prelim + grade.midterm + grade.final) / 3);
}

function App() {
  const [page, setPage] = useState('Dashboard');
  const [role, setRole] = useState('Admin');
  const [grades, setGrades] = useState(startingGrades);
  const [search, setSearch] = useState('');
  const [showForm, setShowForm] = useState(false);
  const [message, setMessage] = useState('');

  const roleGrades = role === 'Student'
    ? grades.filter((grade) => grade.studentId === demoStudentId)
    : role === 'Teacher'
      ? grades.filter((grade) => teacherSubjects.includes(grade.subject))
      : grades;
  const filteredGrades = useMemo(() => {
    const query = search.trim().toLowerCase();
    return roleGrades.filter((grade) => `${grade.name} ${grade.studentId} ${grade.subject}`.toLowerCase().includes(query));
  }, [roleGrades, search]);

  const students = [...new Map(roleGrades.map((grade) => [grade.studentId, grade])).values()];
  const average = roleGrades.length
    ? Math.round(roleGrades.reduce((total, grade) => total + getAverage(grade), 0) / roleGrades.length)
    : 0;
  const needsSupport = roleGrades.filter((grade) => getAverage(grade) < 75).length;
  const navigation = getNavigation(role);

  function saveGrade(event) {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    const studentId = data.get('studentId');
    const student = students.find((item) => item.studentId === studentId);
    const newGrade = {
      id: Date.now(),
      studentId,
      name: student?.name ?? data.get('studentName'),
      subject: data.get('subject'),
      prelim: Number(data.get('prelim')),
      midterm: Number(data.get('midterm')),
      final: Number(data.get('final')),
    };

    setGrades((current) => [newGrade, ...current]);
    setShowForm(false);
    setMessage('Grade added successfully.');
    window.setTimeout(() => setMessage(''), 3000);
  }

  function changeRole(nextRole) {
    setRole(nextRole);
    setPage('Dashboard');
    setSearch('');
  }

  return (
    <div className="app">
      <header className="site-header">
        <a className="site-title" href="#" onClick={() => setPage('Dashboard')}>Student Grade Management</a>
        <nav aria-label="Main navigation">
          {navigation.map((item) => (
            <button
              className={page === item ? 'nav-button selected' : 'nav-button'}
              key={item}
              onClick={() => { setPage(item); setSearch(''); }}
            >
              {item}
            </button>
          ))}
        </nav>
        <label className="role-picker">
          <span>Demo role</span>
          <select aria-label="Choose demo role" value={role} onChange={(event) => changeRole(event.target.value)}>
            <option>Admin</option>
            <option>Teacher</option>
            <option>Student</option>
          </select>
        </label>
      </header>

      <main className="content">
        <div className="page-heading">
          <div>
            <h1>{page}</h1>
            <p>{page === 'Dashboard' ? dashboardDescription(role) : pageDescription(page)}</p>
          </div>
          {role !== 'Student' && (page === 'Dashboard' || page === 'Grades') && (
            <button className="button button-primary" onClick={() => setShowForm(true)}>Add Grade</button>
          )}
        </div>

        {role !== 'Admin' && <p className="demo-notice">Demo view only. Real access is controlled by the Laravel application.</p>}
        {message && <p className="success-message" role="status">{message}</p>}

        {page === 'Dashboard' && (
          <>
            {role === 'Admin' && (
              <section className="summary-grid" aria-label="Summary">
                <SummaryCard label="Students" value="248" />
                <SummaryCard label="Teachers" value="18" />
                <SummaryCard label="Subjects" value={subjects.length} />
                <SummaryCard label="Grade records" value={grades.length} />
              </section>
            )}
            {role === 'Teacher' && (
              <section className="summary-grid" aria-label="Summary">
                <SummaryCard label="Assigned classes" value={teacherSubjects.length} />
                <SummaryCard label="Students in gradebook" value={students.length} />
                <SummaryCard label="Class average" value={`${average}%`} />
                <SummaryCard label="Needs support" value={needsSupport} />
              </section>
            )}
            {role === 'Student' && (
              <section className="summary-grid" aria-label="Summary">
                <SummaryCard label="My subjects" value={roleGrades.length} />
                <SummaryCard label="My average" value={`${average}%`} />
                <SummaryCard label="My status" value={average >= 75 ? 'Passed' : 'Needs support'} />
              </section>
            )}
            <section className="panel">
              <h2>{role === 'Student' ? 'My Grades' : role === 'Teacher' ? 'Recent Class Grades' : 'Recent Grades'}</h2>
              <GradeTable grades={roleGrades.slice(0, 5)} />
              <button className="text-button" onClick={() => setPage(role === 'Student' ? 'Academic Records' : role === 'Teacher' ? 'Grades' : 'Grades')}>View {role === 'Student' ? 'my records' : 'all grades'}</button>
            </section>
          </>
        )}

        {(page === 'Grades' || page === 'Academic Records') && (
          <section className="panel">
            <div className="table-heading">
              <h2>{role === 'Student' ? 'My Academic Records' : 'Grade Records'}</h2>
              <input
                aria-label="Search grades"
                className="search-input"
                placeholder={role === 'Student' ? 'Search my subjects' : 'Search student or subject'}
                value={search}
                onChange={(event) => setSearch(event.target.value)}
              />
            </div>
            <GradeTable grades={filteredGrades} />
            {!filteredGrades.length && <p className="empty-message">No grades found.</p>}
          </section>
        )}

        {page === 'Students' && role === 'Admin' && (
          <section className="panel">
            <div className="table-heading">
              <h2>Students</h2>
              <input
                aria-label="Search students"
                className="search-input"
                placeholder="Search students"
                value={search}
                onChange={(event) => setSearch(event.target.value)}
              />
            </div>
            <StudentTable students={students.filter((student) => `${student.name} ${student.studentId}`.toLowerCase().includes(search.trim().toLowerCase()))} grades={grades} />
          </section>
        )}

        {page === 'Teachers' && role === 'Admin' && <SimpleList title="Teachers" items={['Maria Santos', 'James Miller', 'Grace Tan']} />}

        {page === 'Subjects' && role === 'Admin' && <SimpleList title="Subjects" items={subjects} />}

        {page === 'Classes' && <Classes grades={role === 'Teacher' ? roleGrades : grades} />}

        {page === 'Reports' && role === 'Admin' && (
          <section className="panel report-panel">
            <h2>Grade Summary</h2>
            <p>Average grade: <strong>{average}%</strong></p>
            <p>Passing grade records: <strong>{grades.length - needsSupport}</strong></p>
            <p>Records below 75%: <strong>{needsSupport}</strong></p>
            <p className="report-note">A passing grade is 75% or higher.</p>
          </section>
        )}
      </main>

      <footer className="site-footer">Student Grade Management System</footer>

      {showForm && role !== 'Student' && <GradeForm students={students} allowedSubjects={role === 'Teacher' ? teacherSubjects : subjects} onClose={() => setShowForm(false)} onSave={saveGrade} />}
    </div>
  );
}

function dashboardDescription(role) {
  if (role === 'Teacher') return 'View your assigned classes and manage student grades.';
  if (role === 'Student') return 'View your grades and academic records.';
  return 'Manage students, teachers, classes, subjects, and grades.';
}

function pageDescription(page) {
  return {
    Grades: 'View and manage student grades.',
    Students: 'View students and their current grade averages.',
    Teachers: 'View teacher accounts in the system.',
    Subjects: 'View the subjects offered by the school.',
    Classes: 'View the subjects and class averages.',
    Reports: 'See a summary of student performance.',
    'Academic Records': 'View your grades and final averages.',
  }[page];
}

function SummaryCard({ label, value }) {
  return (
    <article className="summary-card">
      <p>{label}</p>
      <strong>{value}</strong>
    </article>
  );
}

function GradeTable({ grades }) {
  return (
    <div className="table-scroll">
      <table>
        <thead>
          <tr>
            <th>Student</th>
            <th>Student ID</th>
            <th>Subject</th>
            <th>Prelim</th>
            <th>Midterm</th>
            <th>Final</th>
            <th>Average</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          {grades.map((grade) => {
            const average = getAverage(grade);
            return (
              <tr key={grade.id}>
                <td>{grade.name}</td>
                <td>{grade.studentId}</td>
                <td>{grade.subject}</td>
                <td>{grade.prelim}</td>
                <td>{grade.midterm}</td>
                <td>{grade.final}</td>
                <td>{average}%</td>
                <td>{average >= 75 ? 'Passed' : 'Needs support'}</td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
}

function StudentTable({ students, grades }) {
  return (
    <div className="table-scroll">
      <table>
        <thead>
          <tr><th>Student ID</th><th>Student Name</th><th>Subjects</th><th>Average</th><th>Status</th></tr>
        </thead>
        <tbody>
          {students.map((student) => {
            const records = grades.filter((grade) => grade.studentId === student.studentId);
            const average = Math.round(records.reduce((total, grade) => total + getAverage(grade), 0) / records.length);
            return (
              <tr key={student.studentId}>
                <td>{student.studentId}</td>
                <td>{student.name}</td>
                <td>{records.length}</td>
                <td>{average}%</td>
                <td>{average >= 75 ? 'Passed' : 'Needs support'}</td>
              </tr>
            );
          })}
        </tbody>
      </table>
      {!students.length && <p className="empty-message">No students found.</p>}
    </div>
  );
}

function Classes({ grades }) {
  const classAverages = subjects.filter((subject) => grades.some((grade) => grade.subject === subject)).map((subject) => {
    const records = grades.filter((grade) => grade.subject === subject);
    const average = records.length
      ? Math.round(records.reduce((total, grade) => total + getAverage(grade), 0) / records.length)
      : 0;
    return { subject, count: records.length, average };
  });

  return (
    <section className="panel">
      <h2>Classes</h2>
      <div className="table-scroll">
        <table>
          <thead><tr><th>Subject</th><th>Students</th><th>Class Average</th></tr></thead>
          <tbody>
            {classAverages.map((item) => (
              <tr key={item.subject}><td>{item.subject}</td><td>{item.count}</td><td>{item.average}%</td></tr>
            ))}
          </tbody>
        </table>
      </div>
    </section>
  );
}

function SimpleList({ title, items }) {
  return (
    <section className="panel">
      <h2>{title}</h2>
      <ul className="simple-list">{items.map((item) => <li key={item}>{item}</li>)}</ul>
    </section>
  );
}

function GradeForm({ students, allowedSubjects, onClose, onSave }) {
  return (
    <div className="modal-backdrop">
      <section className="modal" role="dialog" aria-modal="true" aria-labelledby="form-title">
        <div className="modal-heading">
          <h2 id="form-title">Add Grade</h2>
          <button className="close-button" type="button" aria-label="Close" onClick={onClose}>×</button>
        </div>
        <form onSubmit={onSave}>
          <label>
            Student
            <select name="studentId" defaultValue="" required>
              <option value="" disabled>Select a student</option>
              {students.map((student) => <option key={student.studentId} value={student.studentId}>{student.name}</option>)}
            </select>
          </label>
          <label>
            Subject
            <select name="subject" defaultValue="Mathematics">
              {allowedSubjects.map((subject) => <option key={subject}>{subject}</option>)}
            </select>
          </label>
          <div className="score-inputs">
            <label>Prelim<input name="prelim" type="number" min="0" max="100" required /></label>
            <label>Midterm<input name="midterm" type="number" min="0" max="100" required /></label>
            <label>Final<input name="final" type="number" min="0" max="100" required /></label>
          </div>
          <div className="form-buttons">
            <button className="button" type="button" onClick={onClose}>Cancel</button>
            <button className="button button-primary" type="submit">Save Grade</button>
          </div>
        </form>
      </section>
    </div>
  );
}

export default App;
