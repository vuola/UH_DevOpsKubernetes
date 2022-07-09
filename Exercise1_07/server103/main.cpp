#include <fmt/chrono.h>
#include <fmt/os.h>
#include <iostream>
#include <random>
#include <string>
#include <chrono>
#include <thread>
 
using namespace std;

std::string random_string()
{
     std::string str("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");

     std::random_device rd;
     std::mt19937 generator(rd());

     std::shuffle(str.begin(), str.end(), generator);

     return str.substr(0, 32);    // assumes 32 < number of characters in str         
}

int main() {

    using namespace std::this_thread; // sleep_for, sleep_until
    using namespace std::chrono; // nanoseconds, system_clock, seconds

    auto rs = random_string();
//    auto out = fmt::output_file("/usr/share/nginx/html/index.html");
//    auto out = fmt::output_file("target/index.html");
    const char* filename = "/usr/share/nginx/html/label.txt";

    while (true)
    {   
        std::time_t t = std::time(nullptr);

        std::FILE* file = std::fopen(filename, "w");
        if (!file)
            throw fmt::system_error(errno, "cannot open file '{}'", filename);
        fmt::print(file, "{:%Y-%m-%d %H:%M:%S}Z {randstr}\n", fmt::gmtime(t), fmt::arg("randstr",rs));
        std::fclose(file);

        sleep_until(system_clock::now() + seconds(5));
    }
}
