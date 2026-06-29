
export interface ApiError {
  code: number;
  message: string;
  validation_errors?: Record<string, string[]>;
}

export interface ApiResponse<T> {
  code: number;
  message:string;
  data: T;
  error:string;
}