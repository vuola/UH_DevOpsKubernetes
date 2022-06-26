cmake_minimum_required(VERSION 3.0.0)
project(logger VERSION 0.1.0)

include(CTest)
find_package(fmt)
# add_subdirectory(/usr/bin/fmt)

enable_testing()
add_executable(logger main.cpp)

set_property(TARGET logger PROPERTY CXX_STANDARD 20)
target_link_libraries(logger fmt::fmt)

set(CPACK_PROJECT_NAME ${PROJECT_NAME})
set(CPACK_PROJECT_VERSION ${PROJECT_VERSION})
include(CPack)
