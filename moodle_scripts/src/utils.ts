export interface Ok {
  data: object;
}

export interface Err {
  error: string;
}

export type Result = Ok | Err;


//for combinations of results and errors
//Ok typeguard
export function isOk(result: Result): result is Ok {
  return (result as Ok).data != undefined;
}

//complete later
function unwrap(result: Result) {
  if (result as Ok) {
    console.log(isOk(result));
  }
}
