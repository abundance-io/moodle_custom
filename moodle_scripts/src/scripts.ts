import { Category, Teacher, User, Course } from "./moodle_types";
import { Result, isOk} from "./utils";
import { parseStringPromise } from "xml2js";
const TOKEN = "";
const BASEQUERY = "";

export function get_id(moodle_object: object): string {
  return "0";
}

export async function get_course_id(course:Course):Promise<Result>{
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_get_courses_by_field",
  });

  let param_block = new URLSearchParams({
    "field":"shortname",
    "value":course.shortname
  })

  let query_string = BASEQUERY + req_params + param_block

  let req_status = await send_request(query_string);
  return req_status;
}

export async function get_user_id(course:Course):Promise<Result>{
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_get_courses_by_field",
  });

  let param_block = new URLSearchParams({
    "field":"fullname",
    "value":course.fullname
  })

  let query_string = BASEQUERY + req_params + param_block

  let req_status = await send_request(query_string);
  return req_status;
}

export async function error_check(xml_string: string): Promise<Result> {
  let status = await parseStringPromise(xml_string).then((result) => {
    if (result["EXCEPTION"]) {
      let error_message = JSON.stringify(result["EXCEPTION"]["MESSAGE"]);
      console.log(error_message);
      return { error: "error_message" };
    } else {
      let data = result["RESPONSE"]["MULTIPLE"];
      return { data: data };
    }
  });
  return status;
}

export async function send_request(query_string: string): Promise<Result> {
  let status = await fetch(query_string)
    .then((response) => response.text())
    // .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
    .then((data) => {
      return error_check(data);
    });
  return status;
}


export async function create_categories(
  category_list: Category[]
): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_create_categories",
  });

  let param_block = new URLSearchParams(
    category_list.reduce((acc, curr, i) => {
      return { ...acc, [`categories[${i}][name]`]: curr["name"] };
    }, {})
  ).toString();
  let query_string = BASEQUERY + req_params + "&" + param_block;

  let req_status = await send_request(query_string);

  return req_status;
}

export async function get_all_categories(): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_get_categories",
  });

  let query_string = BASEQUERY + req_params;
  let req_status = await send_request(query_string);
  return req_status;
}

export async function get_category(name: string): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_get_categories",
  });

  let param_block = new URLSearchParams({
    "criteria[0][key]": "value",
    "criteria[0][value]": name,
  });

  let query_string = BASEQUERY + param_block + req_params;
  let req_status = await send_request(query_string);
  return req_status;
}

export async function create_courses(course_list: Course[]): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_course_create_categories",
  }).toString();

  course_list.forEach(async (course, index) => {
    let category = course.category;
    let category_result = await get_category(category.name);
    //create category if it does not already exist
    if (isOk(category_result)) {
      let category_str = JSON.stringify(category_result);
      if (!category_str.includes(category.name)) {
        create_categories([category]);
      }
    }
    let param_block = new URLSearchParams({
      [`courses[${index}][fullname]`]: course.fullname,
      [`courses[${index}][category]`]: get_id(course.category),
      [`courses[${index}][summary]`]: course.summary,
      [`courses[${index}][shortname]`]: course.shortname,
    });
    req_params += param_block.toString();
  });

  let query_string = BASEQUERY + req_params;
  let req_status = await send_request(query_string);

  return req_status;
}

export async function create_free_users(user_list: User[]): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_user_create_users",
  }).toString();

  user_list.forEach((user, index) => {
    let param_block = new URLSearchParams({
      [`users[${index}][createpassword]`]: JSON.stringify(false),
      [`users[${index}][username]`]: user.username,
      //!!! rememeber to add LADP authentication
      [`users[${index}][firstname]`]: user.firstname,
      [`users[${index}][lastname]`]: user.lastname,
      [`users[${index}][email]`]: user.email,
    });
    req_params += param_block.toString();
  });

  let query_string = BASEQUERY + req_params;
  let req_status = await send_request(query_string);

  return req_status;
}

export async function upgrade_to_premium(user_list: User[]): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_user_update_users",
  }).toString();

  user_list.forEach((user, index) => {
    let param_block = new URLSearchParams({
      [`users[${index}][customfields][0][premium]`]: JSON.stringify(true),
    });
    req_params += param_block.toString();
  });

  let query_string = BASEQUERY + req_params;
  let req_status = await send_request(query_string);

  return req_status;
}

export async function downgrade_to_free(user_list: User[]): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_user_update_users",
  }).toString();

  user_list.forEach((user, index) => {
    let param_block = new URLSearchParams({
      [`users[${index}][customfields][0][premium]`]: JSON.stringify(false),
    });
    req_params += param_block.toString();
  });

  let query_string = BASEQUERY + req_params;
  let req_status = await send_request(query_string);

  return req_status;
}
// to do
export async function enrol_user(
  user: User,
  course_list: Course[]
): Promise<Result> {
  let error_list = [];
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "enrol_manual_enrol_users",
  }).toString();

  course_list.forEach((course, index) => {
    // user_list.forEach(async (user, userindex) => {
    let param_block = new URLSearchParams({
      [`enrolments[${index}][roleid]`]: JSON.stringify(0),
      [`enrolments[${index}][userid]`]: JSON.stringify(get_id(user)),
      [`enrolments[${index}][courseid]`]: JSON.stringify(get_id(course)),
    });
  });

  let query_string = BASEQUERY + req_params;
  let req_status = send_request(query_string);

  return req_status;
}

export async function unenrol_user(
  user: User,
  course_list: Course[]
): Promise<Result> {
  let req_params = new URLSearchParams({
    wstoken: TOKEN,
    wsfunction: "core_manual_unenrol_users",
  }).toString();

  course_list.forEach((course, index) => {
    // user_list.forEach(async (user, userindex) => {
    let param_block = new URLSearchParams({
      [`enrolments[${index}][roleid]`]: JSON.stringify(0),
      [`enrolments[${index}][userid]`]: JSON.stringify(get_id(user)),
      [`enrolments[${index}][courseid]`]: JSON.stringify(get_id(course)),
    });
  });

  let query_string = BASEQUERY + req_params;
  let req_status = send_request(query_string);

  return req_status;
}

