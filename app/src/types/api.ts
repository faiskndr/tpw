
export interface ApiError {
  code: number;
  message: string;
  validation_errors?: Record<string, string[]>;
}