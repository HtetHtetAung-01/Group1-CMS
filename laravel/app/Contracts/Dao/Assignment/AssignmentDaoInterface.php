<?php

namespace App\Contracts\Dao\Assignment;

interface AssignmentDaoInterface {
    public function getAssignmentNamesbyCourseId($course_id);
}