export type UserProfile = {
  id: string;
  name: string;
  email: string;
  role: 'student' | 'admin';
  studentId: string;
  yearLevel: string;
};

export type LoginResponse = {
  token: string;
  user: UserProfile;
};

/*
 * Demo login request.
 *
 * Email:
 * markcatolico@gmail.com
 *
 * Password:
 * 123456
 */
export async function loginRequest(
  email: string,
  password: string
): Promise<LoginResponse> {
  // Simulate a network request.
  await new Promise((resolve) => {
    setTimeout(resolve, 1000);
  });

  const validEmail = 'markcatolico@gmail.com';
  const validPassword = '123456';

  if (
    email.trim().toLowerCase() !== validEmail ||
    password !== validPassword
  ) {
    throw new Error('Invalid email or password.');
  }

  const user: UserProfile = {
    id: '147170',
    name: 'Mark Joseph P. Catolico',
    email: validEmail,
    role: 'student',
    studentId: '147170',
    yearLevel: '3rd Year',
  };

  return {
    token: `student-token-${Date.now()}`,
    user,
  };
}

/*
 * Protected profile request.
 */
export async function getProfile(
  token: string
): Promise<UserProfile> {
  // Simulate a protected network request.
  await new Promise((resolve) => {
    setTimeout(resolve, 700);
  });

  if (!token) {
    throw new Error('UNAUTHORIZED');
  }

  return {
    id: '147170',
    name: 'Mark Joseph P. Catolico',
    email: 'markcatolico@gmail.com',
    role: 'student',
    studentId: '147170',
    yearLevel: '3rd Year',
  };
}