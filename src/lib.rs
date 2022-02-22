use ext_php_rs::prelude::*;
use std::collections::HashMap;

use std::thread;
use std::time::Duration;

use lazy_static::lazy_static;
use std::sync::Mutex;

type MyMap = HashMap<String, String>;

lazy_static! {
    static ref MAP: Mutex<MyMap> = Mutex::new(HashMap::new());
}

#[php_function]
pub fn example_ext_pass_array_of_callbacks(data: HashMap<String, ZendCallable>) {
    for (key, call) in data.iter() {
        call.try_call(vec![]).expect("Failed to call function");
    }
}

#[php_function]
pub fn example_ext_pass_callback(call: ZendCallable) {
    let val = call
        .try_call(vec![&0, &1, &"Hello"])
        .expect("Failed to call function");
    dbg!(val);
}

#[php_function]
pub fn example_ext_set_kv(key: String, value: String) {
    MAP.lock().unwrap().insert(key, value);
}

#[php_function]
pub fn example_ext_get_kv_all() -> MyMap {
    return MAP.lock().unwrap().clone();
}

#[php_function]
pub fn example_ext_threads() {
    let handle = thread::spawn(|| {
        for i in 1..10 {
            println!("hi number {} from the spawned thread!", i);
            thread::sleep(Duration::from_millis(1));
        }
    });

    for i in 1..5 {
        println!("hi number {} from the main thread!", i);
        thread::sleep(Duration::from_millis(1));
    }

    handle.join().unwrap()
}

#[php_module]
pub fn get_module(module: ModuleBuilder) -> ModuleBuilder {
    module
}
