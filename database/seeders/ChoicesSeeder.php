<?php

namespace Database\Seeders;

use App\Models\Choices;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ChoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // True/False Questions
            [
                'title' => 'Flutter is primarily used for web development.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 0,
                'quiz_id' => 1
            ],
            [
                'title' => 'Flutter applications can only be developed for Android devices.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 0,
                'quiz_id' => 1
            ],
            // Multiple Choice Questions
            [
                'title' => 'Which programming language is used for Flutter app development?',
                'answers' => ([
                    ['title' => 'Java', 'is_correct' => 0],
                    ['title' => 'Dart', 'is_correct' => 1],
                    ['title' => 'Swift', 'is_correct' => 0],
                    ['title' => 'Kotlin', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 1
            ],
            [
                'title' => 'What is Flutter?',
                'answers' => ([
                    ['title' => 'A programming language', 'is_correct' => 0],
                    ['title' => 'A UI framework', 'is_correct' => 1],
                    ['title' => 'An operating system', 'is_correct' => 0],
                    ['title' => 'A database management system', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 1
            ],
            // Fill in the Blank Questions
            [
                'title' => 'Flutter uses the _____ programming language.',
                'answers' => ([
                    ['title' => 'dart', 'is_correct' => 1],
                    ['title' => 'dar', 'is_correct' => 1],
                    ['title' => 'dat', 'is_correct' => 1],
                    ['title' => 'drt', 'is_correct' => 1]
                ]),
                'type' => 4, // fill gap question
                'quiz_id' => 1
            ],
            [
                'title' => 'Flutter is developed by _____.',
                'answers' => ([
                    ['title' => 'google', 'is_correct' => 1],
                    ['title' => 'gogle', 'is_correct' => 1],
                    ['title' => 'googl', 'is_correct' => 1],
                    ['title' => 'googe', 'is_correct' => 1]
                ]),
                'type' => 4, // fill gap question
                'quiz_id' => 1
            ],
            // Quiz 2
            // True/False Questions
            [
                'title' => 'Widgets in Flutter are immutable.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 1,
                'quiz_id' => 2
            ],
            [
                'title' => 'In Flutter, everything is a widget.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 1,
                'quiz_id' => 2
            ],
            // Multiple Choice Questions
            [
                'title' => 'Which widget is used to build a row of child widgets?',
                'answers' => ([
                    ['title' => 'Column', 'is_correct' => 0],
                    ['title' => 'Stack', 'is_correct' => 0],
                    ['title' => 'Row', 'is_correct' => 1],
                    ['title' => 'Container', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 2
            ],
            [
                'title' => 'Which widget is used to display text in Flutter?',
                'answers' => ([
                    ['title' => 'Text', 'is_correct' => 1],
                    ['title' => 'Image', 'is_correct' => 0],
                    ['title' => 'Button', 'is_correct' => 0],
                    ['title' => 'ListView', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 2
            ],
            // Fill in the Blank Questions
            [
                'title' => 'To create a container with a red background color, you can use the ______ widget.',
                'answers' => [
                    ['title' => 'container', 'is_correct' => 1],
                    ['title' => 'containe', 'is_correct' => 1],
                    ['title' => 'containr', 'is_correct' => 1],
                    ['title' => 'conainer', 'is_correct' => 1]
                ],
                'type' => 4, // fill gap question
                'quiz_id' => 2
            ],
            [
                'title' => 'The Flutter widget used for handling user gestures is called ______.',
                'answers' => ([
                    ['title' => 'gesturedetecto', 'is_correct' => 1],
                    ['title' => 'gesturdetector', 'is_correct' => 1],
                    ['title' => 'inkwell', 'is_correct' => 1],
                    ['title' => 'inkwel', 'is_correct' => 1]
                ]),
                'type' => 4, // fill gap question
                'quiz_id' => 2
            ],
            // Quiz 3
            // True/False Questions
            [
                'title' => 'Stateless widgets in Flutter can hold mutable state.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 0,
                'quiz_id' => 3
            ],
            [
                'title' => 'Stateful widgets in Flutter can hold mutable state.',
                'answers' => ([]),
                'type' => 1, // true/false question
                'is_true' => 1,
                'quiz_id' => 3
            ],
            // Multiple Choice Questions
            [
                'title' => 'Which widget is an example of a stateless widget in Flutter?',
                'answers' => ([
                    ['title' => 'TextField', 'is_correct' => 1],
                    ['title' => 'Checkbox', 'is_correct' => 0],
                    ['title' => 'DropdownButton', 'is_correct' => 0],
                    ['title' => 'Slider', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 3
            ],
            [
                'title' => 'Which widget is an example of a stateful widget in Flutter?',
                'answers' => ([
                    ['title' => 'IconButton', 'is_correct' => 0],
                    ['title' => 'ListView', 'is_correct' => 1],
                    ['title' => 'FlatButton', 'is_correct' => 0],
                    ['title' => 'Scaffold', 'is_correct' => 0]
                ]),
                'type' => 2, // multiple choice question
                'quiz_id' => 3
            ],
            // More questions...
            [
                'title' => 'Networks of computers have become so powerful that they are used to:',
                'answers' => [
                    ['title' => 'emulate human intelligence b) model the Earth\'s climate', 'isCorrect' => 0],
                    ['title' => 'model the Earth\'s climate', 'isCorrect' => 0],
                    ['title' => 'construct lifelike 3D animations', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'Operating systems can be found in which of the following devices?',
                'answers' => [
                    ['title' => 'cell phones', 'isCorrect' => 0],
                    ['title' => 'automobiles', 'isCorrect' => 0],
                    ['title' => 'MP3 players', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'The software that contains the core components of the operating system is called the --------',
                'answers' => [
                    ['title' => 'Controller', 'isCorrect' => 0],
                    ['title' => 'Kernel', 'isCorrect' => 1],
                    ['title' => 'Root', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'Which of the following statements about computing in the 1940s and 1950s is false?',
                'answers' => [
                    ['title' => 'Machine-language programs could be entered using punched cards. b) The earliest', 'isCorrect' => 0],
                    ['title' => 'The earliest digital computers of the 1940s and 1950s included operating systems.', 'isCorrect' => 0],
                    ['title' => 'Programmers often entered programs in machine language one bit at a time using mechanical switches.', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'Which of the following statements about the single-stream batch-processing systems of the 1950s is false?',
                'answers' => [
                    ['title' => 'Programs were submitted in groups or batches.', 'isCorrect' => 0],
                    ['title' => 'Jobs could run for days at a time.', 'isCorrect' => 0],
                    ['title' => 'Jobs typically required extensive user input during program execution', 'isCorrect' => 1],
                    ['title' => 'An entire program had to be loaded into memory for the program to run.', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => '-------- jobs in a multiprogramming computer system mainly use peripheral devices to perform their tasks.',
                'answers' => [
                    ['title' => 'processor-bound', 'isCorrect' => 0],
                    ['title' => 'compute-bound', 'isCorrect' => 0],
                    ['title' => 'I/O-bound', 'isCorrect' => 1],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'Which of the following was a benefit of the timesharing systems of the 1960s?',
                'answers' => [
                    ['title' => 'The average turnaround time decreased significantly.', 'isCorrect' => 0],
                    ['title' => 'Timesharing made it possible for real-time systems to provide quick results to users.', 'isCorrect' => 0],
                    ['title' => 'Multiple interactive users could operate simultaneously.', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'Ken Thompson and Dennis Ritchie designed the high-level language -------- specifically to implement the UNIX operating system.',
                'answers' => [
                    ['title' => 'Visual Basic', 'isCorrect' => 0],
                    ['title' => 'C++', 'isCorrect' => 0],
                    ['title' => 'Java', 'isCorrect' => 0],
                    ['title' => 'C', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'During the 1970s, communication throughout the United States and across local area networks increased due to the proliferation of the Department of Defense\'s -------- communication standard and Xerox\'s -------- standard',
                'answers' => [
                    ['title' => 'HTTP, TCP/IP', 'isCorrect' => 0],
                    ['title' => 'Ethernet, TCP/IP', 'isCorrect' => 0],
                    ['title' => 'POP, Ethernet', 'isCorrect' => 0],
                    ['title' => 'TCP/IP, Ethernet', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'In the 1980s, software such as spreadsheet programs, word processors, database packages and graphics packages helped drive the -------- revolution by creating demand from businesses that could use these products to increase their productivity.',
                'answers' => [
                    ['title' => 'distributed computing', 'isCorrect' => 0],
                    ['title' => 'mainframe computing', 'isCorrect' => 0],
                    ['title' => 'personal computing', 'isCorrect' => 1],
                    ['title' => 'timesharing', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 21,
            ],
            [
                'title' => 'In a distributed computing environment, clients are',
                'answers' => [
                    ['title' => 'computers that perform requested services.', 'isCorrect' => 0],
                    ['title' => 'user computers that request remote services', 'isCorrect' => 1],
                    ['title' => 'often dedicated to one type of task, such as rendering graphics or managing databases', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'The ------- is grandparent of today\'s Internet',
                'answers' => [
                    ['title' => 'ARPAnet', 'isCorrect' => 1],
                    ['title' => 'TCP/IP protocol', 'isCorrect' => 0],
                    ['title' => 'Ethernet', 'isCorrect' => 0],
                    ['title' => 'World Wide Web', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'The -------- helps ensure that messages are properly routed from sender to receiver and that the messages arrive intact.',
                'answers' => [
                    ['title' => 'HyperText Markup Language (HTML)', 'isCorrect' => 0],
                    ['title' => 'Internet Protocol (IP)', 'isCorrect' => 0],
                    ['title' => 'Transmission Control Protocol (TCP)', 'isCorrect' => 1],
                    ['title' => 'The Ethernet standard', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'Tim Berners-Lee developed the -------- in 1990.',
                'answers' => [
                    ['title' => 'TCP/IP standard', 'isCorrect' => 0],
                    ['title' => 'World Wide Web (WWW)', 'isCorrect' => 1],
                    ['title' => 'Internet', 'isCorrect' => 0],
                    ['title' => 'graphical user interface (GUI)', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'The development of the Internet and World Wide Web made _______ commonplace among personal computers.',
                'answers' => [
                    ['title' => 'distributed computing', 'isCorrect' => 1],
                    ['title' => 'object-oriented programming', 'isCorrect' => 0],
                    ['title' => 'supercomputing', 'isCorrect' => 0],
                    ['title' => 'open-source software', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'The source code of _________ software is distributed freely, allowing programmers to examine and modify the software before compiling and executing it.',
                'answers' => [
                    ['title' => 'proprietary', 'isCorrect' => 0],
                    ['title' => 'open-source', 'isCorrect' => 1],
                    ['title' => 'free', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => '_______ encompass a set of standards that allow applications to exchange data via the Internet.',
                'answers' => [
                    ['title' => 'Web browsers', 'isCorrect' => 0],
                    ['title' => 'Web services', 'isCorrect' => 1],
                    ['title' => 'Distributed computing', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'A system that exhibits massive parallelism ________',
                'answers' => [
                    ['title' => 'has a large number of processors that perform many independent parts of computations in parallel', 'isCorrect' => 1],
                    ['title' => 'has one processor that performs many independent parts of computations at the same time', 'isCorrect' => 0],
                    ['title' => 'communicates over a network to supply a specific set of operations that other applications can invoke', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'A(n) ________ allows programmers to perform complicated system tasks simply by calling predefined functions.',
                'answers' => [
                    ['title' => 'system call', 'isCorrect' => 0],
                    ['title' => 'application programming interface (API)', 'isCorrect' => 1],
                    ['title' => 'Web service', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'Virtual machines promote the ability for software to run on multiple platforms.',
                'answers' => [
                    ['title' => 'scalability', 'isCorrect' => 0],
                    ['title' => 'security', 'isCorrect' => 0],
                    ['title' => 'extensibility', 'isCorrect' => 0],
                    ['title' => 'portability', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 22,
            ],
            [
                'title' => 'Operating systems use ________ operations, often provided by hardware manufacturers, to perform device-specific I/O',
                'answers' => [
                    ['title' => 'APIs', 'isCorrect' => 0],
                    ['title' => 'controllers', 'isCorrect' => 0],
                    ['title' => 'device drivers', 'isCorrect' => 1],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'From the user\'s point of view, plug-and-play devices that are added to the system typically are ready to use _______',
                'answers' => [
                    ['title' => 'after logging off and logging back onto the system.', 'isCorrect' => 0],
                    ['title' => 'immediately, with little or no user interaction.', 'isCorrect' => 1],
                    ['title' => 'after manually configuring the operating system to identify the device.', 'isCorrect' => 0],
                    ['title' => 'after restarting the computer', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'Which of the following hardware components are required to execute instructions in a general-purpose computer?',
                'answers' => [
                    ['title' => 'main memory', 'isCorrect' => 0],
                    ['title' => 'mainboard', 'isCorrect' => 0],
                    ['title' => 'processor', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'The chip ________ typically located on the mainboard, stores instructions for basic hardware initialization and management.',
                'answers' => [
                    ['title' => 'basic input/output system (BIOS)', 'isCorrect' => 1],
                    ['title' => 'firmware', 'isCorrect' => 0],
                    ['title' => 'bootstrap', 'isCorrect' => 0],
                    ['title' => 'device driver', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'A(n) ________ is a piece of hardware that executes a set of machine-language instructions.',
                'answers' => [
                    ['title' => 'controller', 'isCorrect' => 0],
                    ['title' => 'processor', 'isCorrect' => 1],
                    ['title' => 'bus', 'isCorrect' => 0],
                    ['title' => 'motherboard', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'Within a processor, the ________ loads instructions into high-speed memory (i.e., instruction registers), the ________ interprets the instructions and the ________ performs basic arithmetic and logical operations.',
                'answers' => [
                    ['title' => 'arithmetic and logic unit, instruction fetch unit, instruction decode unit', 'isCorrect' => 0],
                    ['title' => 'instruction fetch unit, arithmetic and logic unit, instruction decode unit', 'isCorrect' => 1],
                    ['title' => 'arithmetic and logic unit, instruction decode unit, instruction fetch unit', 'isCorrect' => 0],
                    ['title' => 'instruction fetch unit, instruction decode unit, arithmetic and logic unit', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'dddd',
                'answers' => [
                    ['title' => 'dddd', 'isCorrect' => 0],
                    ['title' => 'dddd', 'isCorrect' => 0],
                    ['title' => 'dddd', 'isCorrect' => 0],
                    ['title' => 'dddd', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'Which type of memory provides the fastest data access?',
                'answers' => [
                    ['title' => 'L1 cache', 'isCorrect' => 0],
                    ['title' => 'L2 cache', 'isCorrect' => 0],
                    ['title' => 'L3 cache', 'isCorrect' => 0],
                    ['title' => 'registers', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'What is the role of a computer system\'s clock generator?',
                'answers' => [
                    ['title' => 'It sets the frequency at which buses in the system transfer data', 'isCorrect' => 1],
                    ['title' => 'It provides power for the computer\'s internal clock.', 'isCorrect' => 0],
                    ['title' => 'It keeps track of the current date and time.', 'isCorrect' => 0],
                    ['title' => 'Both a) and c)', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'Which of the following lists memory types from highest to lowest speed?',
                'answers' => [
                    ['title' => 'registers, L1 cache, secondary storage, main memory', 'isCorrect' => 0],
                    ['title' => 'secondary storage, main memory, L2 cache, registers', 'isCorrect' => 0],
                    ['title' => 'L1 cache, registers, main memory, secondary storage', 'isCorrect' => 0],
                    ['title' => 'registers, L2 cache, main memory, secondary storage', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'Data stored on ________ media (i.e., caches) vanishes when the computer is turned off, whereas ________ media (i.e., hard disks) preserve data when no power is present.',
                'answers' => [
                    ['title' => 'random-access, sequential-access', 'isCorrect' => 0],
                    ['title' => 'volatile, persistent', 'isCorrect' => 1],
                    ['title' => 'persistent, volatile', 'isCorrect' => 0],
                    ['title' => 'dynamic, static', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 23,
            ],
            [
                'title' => 'As manufacturers develop new memory technologies, the speed and capacity of memory tend to _______',
                'answers' => [
                    ['title' => 'increase, decrease', 'isCorrect' => 1],
                    ['title' => 'increase, increase', 'isCorrect' => 0],
                    ['title' => 'decrease, decrease', 'isCorrect' => 0],
                    ['title' => 'decrease, increase', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'Why is hard disk storage much slower to access than main memory?',
                'answers' => [
                    ['title' => 'Disks must be accessed via a hardware controller.', 'isCorrect' => 0],
                    ['title' => 'Disks are located farther from a system\'s processors.', 'isCorrect' => 0],
                    ['title' => 'Accessing data on a hard disk requires mechanical movement of the read/write head', 'isCorrect' => 1],
                    ['title' => 'all of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'Removable media such as CD-Rs generally have ________ capacity and ________ latency than other forms of storage such as hard disks.',
                'answers' => [
                    ['title' => 'lower, lower', 'isCorrect' => 0],
                    ['title' => 'higher, lower', 'isCorrect' => 0],
                    ['title' => 'higher, higher', 'isCorrect' => 0],
                    ['title' => 'lower, higher', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'To prevent signals from colliding on the bus _______, prioritize(s) access to memory by I/O channels and processors.',
                'answers' => [
                    ['title' => 'a controller', 'isCorrect' => 1],
                    ['title' => 'the processor scheduler', 'isCorrect' => 0],
                    ['title' => 'a register', 'isCorrect' => 0],
                    ['title' => 'interrupts', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'A(n) ________ is a bus that connects exactly two devices, and a(n) _______ is a bus that several devices share to perform I/O operations.',
                'answers' => [
                    ['title' => 'data bus, I/O channel', 'isCorrect' => 0],
                    ['title' => 'port, I/O channel', 'isCorrect' => 1],
                    ['title' => 'I/O channel, port', 'isCorrect' => 0],
                    ['title' => 'data bus, port', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => '________ enables devices and controllers to transfer blocks of data to and from main memory directly.',
                'answers' => [
                    ['title' => 'Programmed I/O', 'isCorrect' => 0],
                    ['title' => 'Pipelining', 'isCorrect' => 0],
                    ['title' => 'Interrupt-driven I/O', 'isCorrect' => 0],
                    ['title' => 'Direct memory access (DMA)', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'Which of the following devices is not considered a peripheral device?',
                'answers' => [
                    ['title' => 'printer', 'isCorrect' => 0],
                    ['title' => 'DVD drive', 'isCorrect' => 0],
                    ['title' => 'mainboard', 'isCorrect' => 1],
                    ['title' => 'hard disk drive', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'Which of the following is not a serial interface?',
                'answers' => [
                    ['title' => 'SGSI', 'isCorrect' => 1],
                    ['title' => 'IEEE 1394 (FireWire or iLink)', 'isCorrect' => 0],
                    ['title' => 'USB', 'isCorrect' => 0],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'In what ways do processors support operating system services?',
                'answers' => [
                    ['title' => 'Processors inform the operating system of events such as program execution errors and changes in device status', 'isCorrect' => 0],
                    ['title' => 'Most processors provide mechanisms for memory protection and memory management.', 'isCorrect' => 0],
                    ['title' => 'To create a secure system, processors often implement protection mechanisms by preventing processes from accessing privileged instructions.', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'As computer architectures have evolved, the number of privileged instructions (i.e., those instructions not accessible in user mode) has _________',
                'answers' => [
                    ['title' => 'increased dramatically', 'isCorrect' => 0],
                    ['title' => 'increased', 'isCorrect' => 1],
                    ['title' => 'remained the same', 'isCorrect' => 0],
                    ['title' => 'decreased', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 24,
            ],
            [
                'title' => 'Threads that operate independently of one another but must occasionally interact to perform cooperative tasks are said to execute _________',
                'answers' => [
                    ['title' => 'Simultaneously', 'isCorrect' => 0],
                    ['title' => 'Asynchronously', 'isCorrect' => 1],
                    ['title' => 'Synchronously', 'isCorrect' => 0],
                    ['title' => 'in parallel', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'Preventing more than one thread from accessing a shared variable simultaneously is known as __________ access to the shared variable.',
                'answers' => [
                    ['title' => 'Excluding', 'isCorrect' => 0],
                    ['title' => 'Protecting', 'isCorrect' => 0],
                    ['title' => 'Serializing', 'isCorrect' => 1],
                    ['title' => 'synchronizing', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => '________ restricts access to a shared variable to only one thread at any given time.',
                'answers' => [
                    ['title' => 'Protection', 'isCorrect' => 0],
                    ['title' => 'Serialization', 'isCorrect' => 0],
                    ['title' => 'mutual exclusion', 'isCorrect' => 1],
                    ['title' => 'asynchronism', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'An example of a producer/consumer relationship is _________',
                'answers' => [
                    ['title' => 'a word processor that sends data to a buffer to be printed', 'isCorrect' => 0],
                    ['title' => 'an application that copies data from a fixed-size buffer to a CD-RW', 'isCorrect' => 0],
                    ['title' => 'both a and b', 'isCorrect' => 1],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'In Java, Object method notify transitions a thread from the _______ state to the _______ state.',
                'answers' => [
                    ['title' => 'waiting, ready', 'isCorrect' => 1],
                    ['title' => 'running, waiting', 'isCorrect' => 0],
                    ['title' => 'blocked, waiting', 'isCorrect' => 0],
                    ['title' => 'ready, running', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'In Java, the sleep method call must appear in part of a _______ statement because it might throw an exception indicating that the thread was interrupted before its sleep time expired.',
                'answers' => [
                    ['title' => 'do...while', 'isCorrect' => 0],
                    ['title' => 'if...else', 'isCorrect' => 0],
                    ['title' => 'switch', 'isCorrect' => 0],
                    ['title' => 'try catch', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'Which of the following statements about critical sections is false?',
                'answers' => [
                    ['title' => 'Once a thread has exited its critical section, a waiting thread may enter its critical section.', 'isCorrect' => 0],
                    ['title' => 'If one thread is already in its critical section, another thread must wait for the executing thread to exit its critical section before continuing.', 'isCorrect' => 0],
                    ['title' => 'Only one thread at a time can execute the instructions in its critical section for a particular resource.', 'isCorrect' => 0],
                    ['title' => 'All threads must wait whenever any critical section is occupied.', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'Code inside a critical section should _______',
                'answers' => [
                    ['title' => 'run as quickly as possible', 'isCorrect' => 0],
                    ['title' => 'prevent the possibility of infinite loops', 'isCorrect' => 0],
                    ['title' => 'access shared, modifiable data', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'Code inside a critical section should ________',
                'answers' => [
                    ['title' => 'run as quickly as possible', 'isCorrect' => 0],
                    ['title' => 'prevent the possibility of infinite loops', 'isCorrect' => 0],
                    ['title' => 'access shared, modifiable data', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'The constructs that encapsulate a thread\'s critical section are sometimes called ________',
                'answers' => [
                    ['title' => 'synchronism delimiters.', 'isCorrect' => 0],
                    ['title' => 'protection delimiters', 'isCorrect' => 0],
                    ['title' => 'mutual exclusion primitives', 'isCorrect' => 1],
                    ['title' => 'critical section primitives', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],
            [
                'title' => 'Which property of mutual exclusion primitives is inappropriate for multiprocessor systems?',
                'answers' => [
                    ['title' => 'The solution is implemented purely in software on a machine without specially designed mutual exclusion machine-language instructions.', 'isCorrect' => 1],
                    ['title' => 'A thread must not be indefinitely postponed from entering its critical section.', 'isCorrect' => 0],
                    ['title' => 'No assumption can be made about the relative speeds of asynchronous concurrent threads.', 'isCorrect' => 0],
                    ['title' => 'A thread that is executing instructions outside its critical section cannot prevent any other threads from entering their critical sections.', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 25,
            ],[
                'title' => 'A thread that uses processor cycles to continually test a condition before entering its critical section is said to be ________',
                'answers' => [
                    ['title' => 'Deadlocked', 'isCorrect' => 0],
                    ['title' => 'indefinitely postponed', 'isCorrect' => 0],
                    ['title' => 'lockstep synchronized', 'isCorrect' => 0],
                    ['title' => 'busy waiting', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Lockstep synchronization does not _________',
                'answers' => [
                    ['title' => 'force faster threads to operate at the same speed as slower threads', 'isCorrect' => 0],
                    ['title' => 'improve the efficiency of a process by forcing threads to operate at the same speed', 'isCorrect' => 1],
                    ['title' => 'occur when threads must enter and leave their critical sections in strict alternation', 'isCorrect' => 0],
                    ['title' => 'occur as a result of using a single variable to govern access to threads\' critical sections', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => '_________ occurs when an infinite loop prevents progress in a multithreaded application.',
                'answers' => [
                    ['title' => 'Busy waiting', 'isCorrect' => 0],
                    ['title' => 'Indefinite postponement', 'isCorrect' => 0],
                    ['title' => 'Lockstep synchronization', 'isCorrect' => 0],
                    ['title' => 'Deadlock', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Lamport\'s Bakery Algorithm does not require _________',
                'answers' => [
                    ['title' => 'complicated loops', 'isCorrect' => 0],
                    ['title' => 'a large number of shared variables', 'isCorrect' => 0],
                    ['title' => 'that any operations occur', 'isCorrect' => 0],
                    ['title' => 'all of the above', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Which of the following statements about Lamport\'s Bakery Algorithm is false?',
                'answers' => [
                    ['title' => 'Lamport\'s algorithm enforces mutual exclusion.', 'isCorrect' => 0],
                    ['title' => 'A thread\'s ticket number is reset when the thread exits its critical section', 'isCorrect' => 0],
                    ['title' => 'Lamport\'s algorithm allows multiple threads to obtain the same ticket number.', 'isCorrect' => 0],
                    ['title' => 'The thread possessing the ticket with the highest numerical value can enter its critical section', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Which of the following mutual exclusion algorithms require instructions to be executed atomically?',
                'answers' => [
                    ['title' => 'Peterson\'s algorithm', 'isCorrect' => 0],
                    ['title' => 'Dekker\'s algorithm', 'isCorrect' => 0],
                    ['title' => 'Lamport\'s algorithm', 'isCorrect' => 0],
                    ['title' => 'both a and b', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Disabling interrupts ________',
                'answers' => [
                    ['title' => 'is a viable solution for mutual exclusion in a multiprocessor system', 'isCorrect' => 0],
                    ['title' => 'typically prevents a thread from being preempted while accessing shared data', 'isCorrect' => 0],
                    ['title' => 'on a uniprocessor system could result in an infinite loop causing the system to hang', 'isCorrect' => 0],
                    ['title' => 'both b and c', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'A ________ is a variable that governs access to critical sections.',
                'answers' => [
                    ['title' => 'Flag', 'isCorrect' => 1],
                    ['title' => 'Controller', 'isCorrect' => 0],
                    ['title' => 'Lock', 'isCorrect' => 0],
                    ['title' => 'primitive', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'The test-and-set instruction ___________',
                'answers' => [
                    ['title' => 'prevents deadlock', 'isCorrect' => 0],
                    ['title' => 'prevents indefinite postponement', 'isCorrect' => 0],
                    ['title' => 'eliminates the possibility that a thread is preempted between reading a value from a memory location and writing a new value to the memory location', 'isCorrect' => 1],
                    ['title' => 'none of the above', 'isCorrect' => 0],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Many system architectures support a(n) __________ instruction that enables a thread to exchange the values of two variables atomically',
                'answers' => [
                    ['title' => 'Semaphore', 'isCorrect' => 0],
                    ['title' => 'Switch', 'isCorrect' => 0],
                    ['title' => 'test-and-set', 'isCorrect' => 0],
                    ['title' => 'swap', 'isCorrect' => 1],
                ],
                'type' => 2, // multiple choice question
                'quiz_id' => 26,
            ],
            [
                'title' => 'Contiguous file allocation is most appropriate for ______ .',
                'answers' => [
                    ['title' => 'DVD-RS', 'isCorrect' => false],
                    ['title' => 'CD-RWS', 'isCorrect' => false],
                    ['title' => 'magnetic disk drives', 'isCorrect' => false],
                    ['title' => 'Contiguous allocation is equally appropriate for all of the above.', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'A block allocation scheme allocates files using _______',
                'answers' => [
                    ['title' => 'blocks of noncontiguous sectors', 'isCorrect' => false],
                    ['title' => ' blocks of contiguous sectors', 'isCorrect' => true],
                    ['title' => 'individual sectors', 'isCorrect' => false],
                    ['title' => 'none of the above', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Large block sizes generally ______ the number of I/Q operations required to access file data; small block sizes generally ______ the amount of internal fragmentation.',
                'answers' => [
                    ['title' => 'increase, increase', 'isCorrect' => false],
                    ['title' => 'increase, reduce', 'isCorrect' => false],
                    ['title' => 'reduce, increase', 'isCorrect' => false],
                    ['title' => 'reduce, reduce', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Microsoft\'s FAT file system uses a(n) file allocation scheme.',
                'answers' => [
                    ['title' => 'contiguous', 'isCorrect' => false],
                    ['title' => 'tabular noncontiguous', 'isCorrect' => true],
                    ['title' => 'linked-list noncontiguous', 'isCorrect' => false],
                    ['title' => 'indexed noncontiguous', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'An inode stores ________ .',
                'answers' => [
                    ['title' => 'Opointers to continuation index blocks', 'isCorrect' => false],
                    ['title' => 'the addresses for some of a file\'s data blocks', 'isCorrect' => false],
                    ['title' => 'a file\'s attributes', 'isCorrect' => false],
                    ['title' => 'all of the above', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Which of the following statements is true?',
                'answers' => [
                    ['title' => 'Tabular and indexed noncontiguous file allocation exhibit faster lookup times than contiguous file allocations.', 'isCorrect' => false],
                    ['title' => 'Tabular noncontiguous file allocation yields good performance only when the file system cache is large.', 'isCorrect' => false],
                    ['title' => 'Indexed noncontiguous file allocation allows the file system to locate any block of file by following a bounded, small number of pointers.', 'isCorrect' => true],
                    ['title' => 'none of the above', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Bitmaps allow the file \'type\' to _______ quickly; free lists enable the file system to _______ quickly.',
                'answers' => [
                    ['title' => 'find contiguous blocks, find the next available block', 'isCorrect' => false],
                    ['title' => 'find the next available block, find contiguous blocks', 'isCorrect' => false],
                    ['title' => 'find the first available block, find contiguous blocks', 'isCorrect' => true],
                    ['title' => 'find contiguous blocks, defragment the file system', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Which one of the following statements about free space management techniques is false?',
                'answers' => [
                    ['title' => 'The file system typically maintains free blocks in a free list, sorted by memory address.', 'isCorrect' => true],
                    ['title' => 'Bitmaps allow the file system to quickly determine if contiguous blocks are available at certain memory locations.', 'isCorrect' => false],
                    ['title' => 'The last entry of the last free list block typically stores a null pointer.', 'isCorrect' => false],
                    ['title' => 'The ith bit in a bitmap typically corresponds to the ith block in the file system .', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Which one of the following statements about access control matrices is true?',
                'answers' => [
                    ['title' => 'In an installation with a large number of users and number of files, the matrix would be quite small.', 'isCorrect' => false],
                    ['title' => 'The entry ay is 1 if user i is allowed access to file j.', 'isCorrect' => false],
                    ['title' => 'Because allowing access to a file is the exception rather than the rule, the matrix will be rather dense.', 'isCorrect' => false],
                    ['title' => 'The entry ay is 1 if user i may not be access file J.', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Which of the following lists presents user classes in order from least restrictive to most restrictive?',
                'answers' => [
                    ['title' => 'public, group, owner', 'isCorrect' => true],
                    ['title' => 'public, owner, group', 'isCorrect' => false],
                    ['title' => 'group, owner, public', 'isCorrect' => false],
                    ['title' => 'owner, group, public', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Public access rights, by default, typically allow users to ________',
                'answers' => [
                    ['title' => 'read and execute a file, but not write it', 'isCorrect' => true],
                    ['title' => 'read a file, but not execute or write it', 'isCorrect' => false],
                    ['title' => 'read and write a file, but not execute it', 'isCorrect' => false],
                    ['title' => 'read, execute and write a file', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' ________ typically are used when the sequence in which records are to be processed can be anticipated; ________ generally are used when the sequence in which records are to be processed cannot be anticipated.',
                'answers' => [
                    ['title' => 'Basic access methods, queued access methods', 'isCorrect' => false],
                    ['title' => 'Sequential access methods, basic access methods', 'isCorrect' => false],
                    ['title' => 'Queued access methods, basic access methods', 'isCorrect' => true],
                    ['title' => 'Basic access methods, sequential access methods', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Memory-mapped files ________ ',
                'answers' => [
                    ['title' => 'map file data to a process\'s virtual address space', 'isCorrect' => false],
                    ['title' => 'map file data to file system caches', 'isCorrect' => false],
                    ['title' => 'simplify application programming.', 'isCorrect' => false],
                    ['title' => 'both a and c', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Which of the following statements about backup operations is false?qq',
                'answers' => [
                    ['title' => 'Logical backups store file system data and its logical structure.', 'isCorrect' => false],
                    ['title' => 'Physical backups duplicate a storage device\'s data at the bit level', 'isCorrect' => false],
                    ['title' => 'Physical backups are appropriate for a user to restore a single file from the backup.', 'isCorrect' => true],
                    ['title' => 'Logical backups may not store hidden system files.', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Which \'type\' of backup would be best suited for a mission-critical system that modifies a small number of files between backups?',
                'answers' => [
                    ['title' => 'infrequent logical backup', 'isCorrect' => false],
                    ['title' => 'frequent incremental backup', 'isCorrect' => true],
                    ['title' => 'requent physical backup', 'isCorrect' => false],
                    ['title' => 'infrequent incremental backup', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'Transaction-based logging reduces the risk of data loss by using transactions, which perform a group of operations in their entirety, or not at all.',
                'answers' => [
                    ['title' => 'atomic', 'isCorrect' => true],
                    ['title' => 'virtual', 'isCorrect' => false],
                    ['title' => 'shadow', 'isCorrect' => false],
                    ['title' => 'exclusive', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => 'If an error occurs that prevents a transaction from completing, transaction- based logging allows the system to \'________\' before the transaction began. the system to the state',
                'answers' => [
                    ['title' => 'restore', 'isCorrect' => false],
                    ['title' => 'roll back', 'isCorrect' => true],
                    ['title' => 'reset', 'isCorrect' => false],
                    ['title' => 'unwind', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Because data is written ________ in an LFS, each write times generally ________ compared to traditional file systems.',
                'answers' => [
                    ['title' => 'nonsequentially, decrease', 'isCorrect' => false],
                    ['title' => 'sequentially, decrease', 'isCorrect' => true],
                    ['title' => 'nonsequentially, increase', 'isCorrect' => false],
                    ['title' => 'sequentially, increase', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' Which one of the following statements about file servers and distributed systems is false?',
                'answers' => [
                    ['title' => 'In an NFS network, each computer maintains a file system that can act as a server and/or a client.', 'isCorrect' => false],
                    ['title' => 'A distributed file system enables users to treat remote files in a computer network in much the same manner as local files.', 'isCorrect' => false],
                    ['title' => 'A file server is a computer system dedicated to resolving intercomputer file references.', 'isCorrect' => false],
                    ['title' => 'NFS networks must contain computers running the same operating system.', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],
            [
                'title' => ' A database system includes ________ .',
                'answers' => [
                    ['title' => 'the data in the database.', 'isCorrect' => false],
                    ['title' => 'the hardware on which the data resides.', 'isCorrect' => false],
                    ['title' => 'the software that controls access to the data.', 'isCorrect' => false],
                    ['title' => 'all of the above', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 28
            ],  [
                'title' => 'A file is ________',
                'answers' => [
                    ['title' => 'stored exclusively on persistent storage devices such as hard disks, CDs or DVDS', 'isCorrect' => false],
                    ['title' => 'is manipulated as a unit by operations such as open, close, create or destroy', 'isCorrect' => true],
                    ['title' => 'is a named collection of data', 'isCorrect' => false],
                    ['title' => 'a and b only', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => '________A is the number of bits a processor can operate on at once.',
                'answers' => [
                    ['title' => 'register', 'isCorrect' => false],
                    ['title' => 'cache line', 'isCorrect' => false],
                    ['title' => 'word', 'isCorrect' => true],
                    ['title' => 'byte', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Unicode _______',
                'answers' => [
                    ['title' => 'contains a 64-bit version to support the Chinese character set', 'isCorrect' => false],
                    ['title' => 'is the internationally recognized standard character set popular in Internet and multilingual applications', 'isCorrect' => true],
                    ['title' => 'is compatible with the EBCDIC character set', 'isCorrect' => false],
                    ['title' => 'all of the above', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Which of the following lists elements of the data hierarchy in order from smallest to largest?',
                'answers' => [
                    ['title' => 'field, record, file system', 'isCorrect' => true],
                    ['title' => 'word, byte, record', 'isCorrect' => false],
                    ['title' => 'word, record, field', 'isCorrect' => false],
                    ['title' => 'record, field, file system, database', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Files may be characterized by attributes such as _______',
                'answers' => [
                    ['title' => 'size', 'isCorrect' => false],
                    ['title' => 'priority', 'isCorrect' => false],
                    ['title' => 'activity', 'isCorrect' => false],
                    ['title' => 'both a and c', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'The volatility attribute of a file specifies _______',
                'answers' => [
                    ['title' => 'restrictions placed on access to data in a file', 'isCorrect' => false],
                    ['title' => 'the frequency with which additions and deletions are made to a file', 'isCorrect' => true],
                    ['title' => 'the percentage of a file\'s records accessed during a given period of time', 'isCorrect' => false],
                    ['title' => 'whether the file is stored on a volatile medium', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'In a file with variable-length records, records may vary in size up to the _______ size.',
                'answers' => [
                    ['title' => 'field', 'isCorrect' => false],
                    ['title' => 'word', 'isCorrect' => false],
                    ['title' => 'record', 'isCorrect' => false],
                    ['title' => 'block', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'A file system is responsible for _______ .',
                'answers' => [
                    ['title' => 'file integrity mechanisms', 'isCorrect' => false],
                    ['title' => 'auxiliary storage management', 'isCorrect' => false],
                    ['title' => 'file management', 'isCorrect' => false],
                    ['title' => 'all of the above', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'myFile.txt is an example of a _______ , whereas \'disk 2, blocks 782-791\' is an example of a _______ .',
                'answers' => [
                    ['title' => 'logical device name, physical device name', 'isCorrect' => false],
                    ['title' => 'physical device name, logical device name', 'isCorrect' => false],
                    ['title' => 'symbolic name, physical device name', 'isCorrect' => true],
                    ['title' => 'physical device name, symbolic name', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'A _______ view of data is concerned with the layout of file data on a storage device.',
                'answers' => [
                    ['title' => 'symbolic', 'isCorrect' => false],
                    ['title' => 'logical', 'isCorrect' => false],
                    ['title' => 'physical', 'isCorrect' => true],
                    ['title' => 'device', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Which of the following statements about directories is false?',
                'answers' => [
                    ['title' => 'Directories may contain a \'type\' field that specifies a description of a file\'s purpose.', 'isCorrect' => false],
                    ['title' => 'Directories contain the names and locations of other files in the file system.', 'isCorrect' => false],
                    ['title' => 'Directories often store user data.', 'isCorrect' => true],
                    ['title' => 'Directories may contain the access times and modified times of files.', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'In a hierarchically structured file system, the name of a file is formed by the pathname from the _______ to the file.',
                'answers' => [
                    ['title' => 'base directory', 'isCorrect' => false],
                    ['title' => 'relative directory', 'isCorrect' => false],
                    ['title' => 'user directory', 'isCorrect' => false],
                    ['title' => 'root directory', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'The _______ path to a file is the path beginning at the root.',
                'answers' => [
                    ['title' => 'relative', 'isCorrect' => false],
                    ['title' => 'working', 'isCorrect' => false],
                    ['title' => 'absolute', 'isCorrect' => true],
                    ['title' => 'symbolic', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Which one of the following statements about links is false?',
                'answers' => [
                    ['title' => 'File systems typically update soft links when a referenced file is moved to a different directory.', 'isCorrect' => true],
                    ['title' => 'A hard link is a directory entry that specifies the physical location of a file.', 'isCorrect' => false],
                    ['title' => 'A soft link is a directory entry containing the pathname for another file', 'isCorrect' => false],
                    ['title' => 'A hard link may reference invalid data if the physical location of the corresponding file changes.', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'A file system\'s metadata may contain ______ .',
                'answers' => [
                    ['title' => 'the time at which a file was last modified', 'isCorrect' => false],
                    ['title' => 'the locations of a storage device\'s free blocks', 'isCorrect' => false],
                    ['title' => 'both a and b', 'isCorrect' => true],
                    ['title' => 'none of the above', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'The \'type\' of file system on a storage device is often specified by the _______ in the _______ .',
                'answers' => [
                    ['title' => 'file system identifier, root directory', 'isCorrect' => false],
                    ['title' => 'file system name, root directory', 'isCorrect' => false],
                    ['title' => 'file system identifier, superblock', 'isCorrect' => true],
                    ['title' => 'file system name, root directory', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'The mount command combines multiple file systems into one _______ and allows users to access data from different locations as if all files were located inside the native file system',
                'answers' => [
                    ['title' => 'namespace', 'isCorrect' => true],
                    ['title' => 'root directory', 'isCorrect' => false],
                    ['title' => 'physical view', 'isCorrect' => false],
                    ['title' => 'pathname', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'What typically happens when a file system\'s mount point contains directories of the native file system?',
                'answers' => [
                    ['title' => 'The contents of the native file system\'s directory at the mount point are deleted.', 'isCorrect' => false],
                    ['title' => 'The contents of the mounted file system and the native file system are merged, with the mounted file system\'s contents taking precedence in the case of any duplicate directory or file names.', 'isCorrect' => false],
                    ['title' => 'The contents of the mounted file system and the native file system are merged, with the native file system\'s contents taking precedence in the case of any duplicate directory or file names.', 'isCorrect' => false],
                    ['title' => 'The contents of the native file system\'s directory at the mount point are temporarily hidden.', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'The _______ file organization scheme places records on disk in logical sequence according to a key contained in each record.',
                'answers' => [
                    ['title' => 'sequential', 'isCorrect' => false],
                    ['title' => 'direct', 'isCorrect' => false],
                    ['title' => 'partitioned', 'isCorrect' => false],
                    ['title' => 'indexed sequential', 'isCorrect' => true],
                ],
                'type' => 2,
                'quiz_id' => 27
            ],
            [
                'title' => 'Contiguous file allocation is inappropriate for general-purpose file systems because ______',
                'answers' => [
                    ['title' => 'if a file grows beyond the size originally specified and there are no adjacent free blocks, the file must be transferred to a new area of adequate size', 'isCorrect' => true],
                    ['title' => 'locating file data is complicated, because the system must store multiple memory addresses to reference a file.', 'isCorrect' => false],
                    ['title' => 'successive logical records typically are physically adjacent to one another', 'isCorrect' => false],
                    ['title' => 'all of the above', 'isCorrect' => false],
                ],
                'type' => 2,
                'quiz_id' => 27
            ]
        ];

        foreach ($questions as $question) {
            $question1 = new Question();
            $question1->title = $question['title'];
            $question1->quiz()->associate($question['quiz_id']);
            $question1->type = $question['type'];
            if (isset($question['is_true'])) {
                $question1->isTrue = $question['is_true'];
            }

            $question1->save();
            if (isset($question['answers'])) {
                foreach ($question['answers'] as $answer) {

                    $data = [
                        'title' => $answer['title'],
                    ];
                    if (isset($answer['isCorrect'])) {
                        $data['correct'] = $answer['isCorrect'];
                    }
                    if (isset($answer['order'])) {
                        $data['order'] = $answer['order'];
                    }
                    $choice = $question1->choices()->create(
                        $data);

                }
            }

        }
    }
}
