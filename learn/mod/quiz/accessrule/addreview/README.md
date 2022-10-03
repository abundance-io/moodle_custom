# Add review attempt #

Allows students that missed a quiz to review the feedback anyway

This plugin changes the behaviour of the quiz after it is closed. Students
that have not attempted the quiz at all will be able to attempt it once
however the attempt will end immediately before they have a chance to
answer. The attempt will appear for review according to the conditions
set for normal attempts.

Note, this plugin requires Moodle 3.4+ (2017111300).

The plugin is installed under `mod/quiz/accessrule/addreview`.  For example

    git clone https://github.com/dthies/moodle-quizaccess_addreview.git mod/quiz/accessrule/addreview

To enable it for a particular quiz, select the option under 'Review
options'.  That is to say navigate to

    Edit settings -> Review options -> Allow review attempt 



## License ##

2018 Daniel Thies <dethies@gmail.com>

This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the
Free Software Foundation, either version 3 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License
for more details.

You should have received a copy of the GNU General Public License along
with this program.  If not, see <http://www.gnu.org/licenses/>.
