<?php
/**
 *doctorweb
 *ASUS
 *3/16/2022
 *2:10 AM
 *SRILANKA-AXCITO
 */

namespace App\Service;

use App\Constants\Constants;
use App\ServiceInterface\PatientServiceInterface;

class PatientService
{
    /**
     * @var PatientServiceInterface
     */
    protected PatientServiceInterface $patientServiceInterface;

    /**
     * @param PatientServiceInterface $patientServiceInterface
     */

    public function __construct(PatientServiceInterface $patientServiceInterface)
    {
        $this->patientServiceInterface = $patientServiceInterface;
    }

    /**
     * @param $request
     * @return mixed
     */

    public function register($request): mixed
    {
        $inputData = [
            'phone_number' => $request['phone_number'],
            'patient_name' => $request['patient_name'],
            'age' => $request['age'],
            'device' => $request['device'],
            'interview_completed' => $request['interview_completed']
        ];
        return $this->patientServiceInterface->register($inputData);
    }

    /**
     * @param $request
     * @return mixed
     */

    public function getAllPatient($request): mixed
    {
        $filteredValue = $this->patientServiceInterface->getAllPatient($request);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::N0_PATIENTS_FOUND;
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function getPatientByPhone($request): mixed
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->getPatientByPhone($mobile_number);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function addNewPatient($request): mixed
    {
        $patientDetails = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'dob' => $request['dob'],
            'age' => $request['age'],
            'mobile_number' => $request['mobile_number'],
            'gender' => $request['gender'],
            'ethnicity' => $request['ethnicity'],
            'relationship_status' => $request['relationship_status'],
            'highest_education' => $request['highest_education'],
        ];

        $medicalRatio = [
            'mobile_number' => $request['mobile_number'],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'bmi' => $request['bmi'],
            'waist' => $request['waist'],
            'hip' => $request['hip'],
            'waist_hip_ratio' => $request['waist_hip_ratio'],
            'bp' => $request['bp'],
            'lipid_pannel' => $request['lipid_pannel'],
            'a1c' => $request['a1c'],
            'current_health_status' => $request['current_health_status'],
        ];

        $technologyLiteracy = [
            'mobile_number' => $request['mobile_number'],
            'download_use_skill_level' => $request['download_use_skill_level'],
            'search_online_skill_level' => $request['search_online_skill_level'],
            'social_media_skill_level' => $request['social_media_skill_level'],
            'email_usage_skill_level' => $request['email_usage_skill_level'],
            'online_credit_card_usage_skill_level' => $request['online_credit_card_usage_skill_level'],
        ];

        $goal = [
            'mobile_number' => $request['mobile_number'],
            'selected_goal' => $request['selected_goal'],
            'selected_behaviour_change' => $request['selected_behaviour_change'],

        ];

        $filteredValue = $this->patientServiceInterface->addNewPatient($patientDetails, $medicalRatio, $technologyLiteracy, $goal);

        if ($filteredValue['mobile_number'] == null) {
            return Constants::REPEATED_PHONE_NUMBER;
        } else {
            return $filteredValue;
        }

    }

    /**
     * @param $request
     * @return mixed
     */
    public function removePatient($request): mixed
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->removePatient($mobile_number);

        if ($filteredValue) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function updatePatient($request): mixed
    {
        $patientDetails = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'dob' => $request['dob'],
            'age' => $request['age'],
            'mobile_number' => $request['mobile_number'],
            'ethnicity' => $request['ethnicity'],
            'relationship_status' => $request['relationship_status'],
            'highest_education' => $request['highest_education'],
        ];

        $medicalRatio = [
            'mobile_number' => $request['mobile_number'],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'bmi' => $request['bmi'],
            'waist' => $request['waist'],
            'hip' => $request['hip'],
            'waist_hip_ratio' => $request['waist_hip_ratio'],
            'bp' => $request['bp'],
            'lipid_pannel' => $request['lipid_pannel'],
            'a1c' => $request['a1c'],
            'current_health_status' => $request['current_health_status'],
        ];

        $technologyLiteracy = [
            'mobile_number' => $request['mobile_number'],
            'download_use_skill_level' => $request['download_use_skill_level'],
            'search_online_skill_level' => $request['search_online_skill_level'],
            'social_media_skill_level' => $request['social_media_skill_level'],
            'email_usage_skill_level' => $request['email_usage_skill_level'],
            'online_credit_card_usage_skill_level' => $request['online_credit_card_usage_skill_level'],
        ];

        $goal = [
            'mobile_number' => $request['mobile_number'],
            'selected_goal' => $request['selected_goal'],
            'selected_behaviour_change' => $request['selected_behaviour_change'],

        ];

        return $this->patientServiceInterface->updatePatient($patientDetails, $medicalRatio, $technologyLiteracy, $goal);
    }

    /**
     * @param $request
     * @return mixed
     */

    public function getPatientDetails($request): mixed
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->getPatientDetails($mobile_number);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }

    /**
     * @param $request
     * @return array
     */

    public function addPatientDailyStatus($request): array
    {
        $isDataStored = $this->patientServiceInterface->addPatientDailyStatus($request);

        if ($isDataStored === true) {
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => Constants::PARENT_RECORD_DOES_NOT_EXIST
            ];
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function getPatientDailyStatus($request): mixed
    {
        $filteredValue = $this->patientServiceInterface->getPatientDailyStatus($request);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::N0_PATIENTS_FOUND;
        }
    }

    /**
     * @param $request
     * @return int|array
     */

    public function addWeightLoseGoalDetails($request): int|array
    {
        $goalData = [
            'mobile_number' => $request['mobile_number'],
            'goal_id' => $request['goal_id'],
            'goal' => $request['goal'],
            'target_weight' => $request['target_weight'],
            'desired_time_frame' => $request['desired_time_frame'],
            'motivation_factor_for_goal_manual' => $request['motivation_factor_for_goal_manual'],
            'motivation_factor_for_goal_selected' => $request['motivation_factor_for_goal_selected'],
            'level_of_motivation' => $request['level_of_motivation'],
            'motivation_target_10_text' => $request['motivation_target_10_text'],
            'contribute_favtors_selected' => $request['contribute_favtors_selected'],
//            'contribute_favtors_manually_added' => $request['contribute_favtors_manually_added'],
            'no_one_fouca_factor' => $request['no_one_fouca_factor'],
            'previously_attempted' => $request['previously_attempted'],
            'attempted_yes_success_factors' => $request['attempted_yes_success_factors'],
            'attempted_yes_success_challenges' => $request['attempted_yes_success_challenges'],
            'attempted_no_success_factors' => $request['attempted_no_success_factors'],
            'attempted_no_success_challenges' => $request['attempted_no_success_challenges'],
            'what_stopped_you_from_continue' => $request['what_stopped_you_from_continue'],
            'what_has_prevented_you_from_restarting' => $request['what_has_prevented_you_from_restarting'],
            'confident_factor' => $request['confident_factor'],
            'confident_to_change_encouragement' => $request['confident_to_change_encouragement'],
            'look_forward_factors' => $request['look_forward_factors'],

        ];

        $filteredValue = $this->patientServiceInterface->addWeightLoseGoalDetails($goalData);
//        dd($filteredValue);

        if ($filteredValue === "1005") {
            return Constants::PATIENT_ALL_READY_EXIST_IN_PATIENT_GOAL_TABLE;
        } else if ($filteredValue === "1006") {
            return Constants::PARENT_RECORD_DOES_NOT_EXIST;
        } else if ($filteredValue['mobile_number'] !== null) {
            return [
                'mobile_number' => $filteredValue['mobile_number']
            ];
        }
    }

    /**
     * @param $request
     * @return int|array
     */

    public function getWeightLoseGoalDetailsByMobileNumber($request): int|array
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->getWeightLoseGoalDetailsByMobileNumber($mobile_number);
//        dd($filteredValue);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }

    /**
     * @param $data
     * @return mixed
     */

    public function addDoctorRecommendation($data): mixed
    {
        return $this->patientServiceInterface->addDoctorRecommendation($data);
    }

    /**
     * @param $request
     * @return int|array
     */

    public function getPreviousRecommendationByMobileNumber($request): int|array
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->getPreviousRecommendationByMobileNumber($mobile_number);
//        dd($filteredValue);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }

    /**
     * @param $request
     * @return array|int
     */

    public function getDailyStatus($request): int|array
    {
        $mobile_number = $request['mobile_number'];
        $patientStatus = $this->patientServiceInterface->getDailyStatus($mobile_number);

//        $dailyStatusArr = array(
//            "mobile_number" => $patientStatus['mobile_number'],
//            'first_name' => $patientStatus['first_name'],
//            'last_name' => $patientStatus['last_name'],
//            'age' => $patientStatus['age'],
//            'weight' => $patientStatus['weight'],
//            'waist_hip_ratio' => $patientStatus['waist_hip_ratio'],
//            'selected_goal' => $patientStatus['selected_goal'],
//            'recommendation' => $patientStatus['recommendation'],
//        );
        $dailyStatusArr = array(
            "patient_id" => $patientStatus['mobile_number'],
            'patient_fname' => $patientStatus['first_name'],
            'patient_lname' => $patientStatus['last_name'],
            'age' => $patientStatus['age'],
            'weight' => $patientStatus['weight'],
            'ratio' => $patientStatus['waist_hip_ratio'],
            'goal' => $patientStatus['selected_goal'],
            'recommendation' => $patientStatus['recommendation'],
        );
        if (count($dailyStatusArr) > 0) {
            return $dailyStatusArr;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }

    }

    public function editPatientByMobileNumber($request)
    {
        $data = $request->all();
        $patientStatus = $this->patientServiceInterface->editPatientByMobileNumber($data);
    }

    public function addPatientRecommendedTask($request)
    {
        $data = [
            'mobile_number' => $request['mobile_number'],
            'recommended_tasks' => $request['recommended_tasks'],
        ];
        $addPatientRecommendedTaskStatus = $this->patientServiceInterface->addPatientRecommendedTask($data);
//        dd($addPatientRecommendedTaskStatus);
        if ($addPatientRecommendedTaskStatus == 23000) {
            return Constants::INVALID_PHONE_NUMBER;
        } else {
            return true;
        }
    }

    public function getPatientRecommendedTask($request)
    {
        $mobile_number = $request['mobile_number'];
        $patientRecommendedTask = $this->patientServiceInterface->getPatientRecommendedTask($mobile_number);
//        dd($patientRecommendedTask);
        if ($patientRecommendedTask == 0) {
            return false;
        } else {
            return $patientRecommendedTask['recommended_tasks'];
        }
    }

    public function checkRecommendedTaskStatus($request)
    {
        $mobile_number = $request['mobile_number'];
        $task1CheckedArr = [];
        $patientRecommendedTask = $this->patientServiceInterface->getPatientRecommendedTask($mobile_number);
        $patientRecommendedTaskArr = explode("|", $patientRecommendedTask['recommended_tasks']);
        $patientRecommendedTask1 = $patientRecommendedTaskArr[0];
        $task1PatientDailyStatusDetails = $this->patientServiceInterface->checkRecommendedTaskStatus($mobile_number, $patientRecommendedTask1);
        $task1Status = $this->getStatus($task1PatientDailyStatusDetails);
        if (count($task1Status) > 0){
            if ($task1Status[0] == "Yes"){
                $task1CheckedArr =[
                    "recommendedTask1" => "Done"
                ];
            }else{
                $task1CheckedArr =[
                    "recommendedTask1" => "Not Done"
                ];
            }
        }

        if (!($patientRecommendedTaskArr[1] == "")) {
            $patientRecommendedTask2 = $patientRecommendedTaskArr[1];
            $task2PatientDailyStatusDetails = $this->patientServiceInterface->checkRecommendedTaskStatus($mobile_number, $patientRecommendedTask2);
            $task2Status = $this->getStatus($task2PatientDailyStatusDetails);
            if (count($task2Status) > 0){
                if ($task2Status[0] == "Yes"){
                    $task2CheckedArr =[
                        "recommendedTask2" => "Done"
                    ];
                }else{
                    $task2CheckedArr =[
                        "recommendedTask2" => "Not Done"
                    ];
                }
                return array_merge($task1CheckedArr, $task2CheckedArr);
            }
        }
        return array_merge($task1CheckedArr);
    }

    public function getStatus($patientDailyStatusDetailsOfTasks)
    {
        $statusArr = array();
        for ($x = 0; $x < count($patientDailyStatusDetailsOfTasks); $x++) {
            array_push($statusArr,$patientDailyStatusDetailsOfTasks[$x]['follow_rec']);
        }
        return $statusArr;
    }

    public function getPatientPreviousRecommendedTask($request)
    {
        $mobile_number = $request['mobile_number'];
        $patientRecommendedTask = $this->patientServiceInterface->getPatientRecommendedTask($mobile_number);
//        dd($patientRecommendedTask);
        if ($patientRecommendedTask == 0) {
            return false;
        } else {
            return $patientRecommendedTask['previous_recommended_tasks'];
        }
    }

    public function patientFollowUp($request)
    {
        $followUpDetails = array(
            'id' => $request['id'],
            'mobile_number' => $request['mobile_number'],
            'time_start' => $request['time_start'],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'bmi' => $request['bmi'],
            'average' => $request['average'],
            'self_eval' => $request['self_eval'],
            'last_week_exp' => $request['last_week_exp'],
            'main_barriers' => $request['main_barriers'],
            'main_posotive_themes' => $request['main_posotive_themes'],
            'main_negative_themes' => $request['main_negative_themes'],
            'new_strategy' => $request['new_strategy'],
            'recommendation_task1' => $request['recommendation_task1'],
            'recommendation_task2' => $request['recommendation_task2'],
            'confident_goal_factor' => $request['confident_goal_factor'],
            'pre_mortem' => $request['pre_mortem'],
            'time_out' => $request['time_out'],
        );

//        return $this->patientServiceInterface->patientFollowUp($followUpDetails);
        $filteredValue = $this->patientServiceInterface->patientFollowUp($followUpDetails);
        if ($filteredValue['mobile_number'] == null) {
            return Constants::INVALID_PHONE_NUMBER;
        } else {
            return $filteredValue;
        }
    }

    public function getPatientFollowUpDetailsByMobileNumber($request)
    {
        $mobile_number = $request['mobile_number'];
        $filteredValue = $this->patientServiceInterface->getPatientFollowUpDetailsByMobileNumber($mobile_number);
//        dd($filteredValue);
        if (count($filteredValue) > 0) {
            return $filteredValue;
        } else {
            return Constants::INVALID_PHONE_NUMBER;
        }
    }
}
