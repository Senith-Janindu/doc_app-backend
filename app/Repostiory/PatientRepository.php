<?php
/**
 *doctorweb
 *ASUS
 *3/16/2022
 *2:11 AM
 *SRILANKA-AXCITO
 */

namespace App\Repostiory;

use App\Constants\Constants;
use App\Models\Alert;
use App\Models\DoctorRecommendation;
use App\Models\Patient;
use App\Models\PatientDailyStatus;
use App\Models\PatientFollowUp;
use App\Models\PatientGoal;
use App\Models\PatientMedicalRatio;
use App\Models\PatientSocialDeterminantsOfHealth;
use App\Models\PatientTechnologicalLiteracy;
use App\Models\PreviousGoalDetails;
use App\Models\RecommendedTasks;
use App\Models\User;
use App\Models\VideoUrl;
use App\Models\WeightLoseGoal;
use App\ServiceInterface\PatientServiceInterface;
use Illuminate\Database\Eloquent\Model;

class PatientRepository implements PatientServiceInterface
{

    /**
     * @param $inputData
     * @return array|string
     */

    public function register($inputData): array|string
    {
        try {
            $user = Patient::where('phone_number', '=', $inputData['phone_number'])->first();
            if ($user === null) {
                $newUser = new Patient();
                $newUser->fill($inputData);
                $newUser->save();
                return ['user_id' => $newUser->id,];
            } else {
                return ['user_id' => null];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function getAllPatient($request): mixed
    {
        try {
            return Patient::all()->toArray();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $mobile_number
     * @return mixed
     */

    public function getPatientByPhone($mobile_number): mixed
    {
        return Patient::where('mobile_number', $mobile_number)->get();
    }

    /**
     * @param array $patientDetails
     * @param array $medicalRatio
     * @param array $technologyLiteracy
     * @param array $goal
     * @return array|string
     */

    public function addNewPatient(array $patientDetails, array $medicalRatio, array $patientSocialDeterminantsOfHealth, array $technologyLiteracy, array $goal): array|string
    {
        try {
            $user = Patient::where('mobile_number', '=', $patientDetails['mobile_number'])->first();
            if ($user === null) {
                $newUser = new Patient();
                $newUser->fill($patientDetails);
                $newUser->save();

                $newUser = new PatientMedicalRatio();
                $newUser->fill($medicalRatio);
                $newUser->save();

                $newUser = new PatientSocialDeterminantsOfHealth();
                $newUser->fill($patientSocialDeterminantsOfHealth);
                $newUser->save();

                $newUser = new PatientTechnologicalLiteracy();
                $newUser->fill($technologyLiteracy);
                $newUser->save();

                $newUser = new PatientGoal();
                $newUser->fill($goal);
                $newUser->save();

                return ['mobile_number' => $newUser->mobile_number,];
            } else {
                return ['mobile_number' => null];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $mobile_number
     * @return string|int
     */

    public function removePatient($mobile_number): string|int
    {
//        return Patients::where('$mobile_number', $mobile_number)->get();
        try {
            $isDeleted = Patient::destroy($mobile_number);
            if ($isDeleted == true) {
                return $isDeleted;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $patientDetails
     * @param $medicalRatio
     * @param $technologyLiteracy
     * @param $goal
     * @return string|int
     */

    public function updatePatient($patientDetails, $medicalRatio, $patientSocialDeterminantsOfHealth, $technologyLiteracy, $goal): string|int
    {
        $userPhone = $patientDetails['mobile_number'];
        $status = '';
        try {
            $patient = Patient::where('mobile_number', $userPhone)->exists();
            if ($patient == true) {

                Patient::where(['mobile_number' => $userPhone])->update(
                    [
                        'first_name' => $patientDetails['first_name'],
                        'last_name' => $patientDetails['last_name'],
                        'dob' => $patientDetails['dob'],
                        'age' => $patientDetails['age'],
                        'ethnicity' => $patientDetails['ethnicity'],
                        'relationship_status' => $patientDetails['relationship_status'],
                        'highest_education' => $patientDetails['highest_education']
                    ]
                );

                PatientMedicalRatio::where(['mobile_number' => $userPhone])->update(
                    [
                        'weight' => $medicalRatio['weight'],
                        'height' => $medicalRatio['height'],
                        'bmi' => $medicalRatio['bmi'],
                        'waist' => $medicalRatio['waist'],
                        'hip' => $medicalRatio['hip'],
                        'waist_hip_ratio' => $medicalRatio['waist_hip_ratio'],
                        'bp' => $medicalRatio['bp'],
                        'lipid_pannel' => $medicalRatio['lipid_pannel'],
                        'a1c' => $medicalRatio['a1c'],
                        'current_health_status' => $medicalRatio['current_health_status']
                    ]
                );

                PatientSocialDeterminantsOfHealth::where(['mobile_number' => $userPhone])->update(
                    [
                        'mobile_number' => $patientSocialDeterminantsOfHealth['mobile_number'],
                        'agreeableness_level' => $patientSocialDeterminantsOfHealth['agreeableness_level'],
                        'extraversion_level' => $patientSocialDeterminantsOfHealth['extraversion_level'],
                        'conciousnes_level' => $patientSocialDeterminantsOfHealth['conciousnes_level'],
                        'openness_level' => $patientSocialDeterminantsOfHealth['openness_level'],
                        'neuroticism_level' => $patientSocialDeterminantsOfHealth['neuroticism_level'],
                    ]
                );

                PatientTechnologicalLiteracy::where(['mobile_number' => $userPhone])->update(
                    [
                        'download_use_skill_level' => $technologyLiteracy['download_use_skill_level'],
                        'search_online_skill_level' => $technologyLiteracy['search_online_skill_level'],
                        'social_media_skill_level' => $technologyLiteracy['social_media_skill_level'],
                        'email_usage_skill_level' => $technologyLiteracy['email_usage_skill_level'],
                        'online_credit_card_usage_skill_level' => $technologyLiteracy['online_credit_card_usage_skill_level']
                    ]
                );

                PatientGoal::where(['mobile_number' => $userPhone])->update(
                    [
                        'selected_goal' => $goal['selected_goal'],
                        'selected_behaviour_change' => $goal['selected_behaviour_change']
                    ]
                );

                $status = 'Data Successfully updated';

            } elseif ($patient == false) {
                $status = Constants::USER_NOT_FOUND;
            }
            return $status;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $mobile_number
     * @return string|array
     */

    public function getPatientDetails($mobile_number): string|array
    {
        try {
            $patientDataArray = [];

            $patient1 = Patient::find($mobile_number)->toArray();
            $patient2 = Patient::find($mobile_number)->getPatientMedicalRatio->toArray();
            $patient3 = Patient::find($mobile_number)->getPatientSocialDeterminantsOfHealth;
            if ($patient3 == null){
                $patient3 = [];
            }else{
                $patient3 = Patient::find($mobile_number)->getPatientSocialDeterminantsOfHealth->toArray();
            }
            $patient4 = Patient::find($mobile_number)->getPatientTechnologicalLiteracy->toArray();
            $patient5 = Patient::find($mobile_number)->getPatientGoal->toArray();

            return array_merge($patient1, $patient2, $patient3, $patient4, $patient5);

//            $patientDataArray['first_name'] = $patient1->first_name;
//            dd($patientDataArray);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $request
     * @return mixed
     */

    public function addPatientDailyStatus($request): mixed
    {
        try {
            $patientDailyStatus = new PatientDailyStatus();
            $patientDailyStatus->fill($request);
            $patientDailyStatus->save();
            return true;
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    /**
     * @param $request
     * @return array|string
     */

    public function getPatientDailyStatus($request): array|string
    {
        try {
            return PatientDailyStatus::all()->toArray();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $goalData
     * @return string|array
     */

    public function addWeightLoseGoalDetails($goalData): string|array
    {
        try {
            $patientExist = Patient::where('mobile_number', $goalData['mobile_number'])->exists();
            $goalExist = WeightLoseGoal::where('mobile_number', $goalData['mobile_number'])->exists();
            if ($patientExist == true) {
                if ($goalExist == false) {
                    $newUser = new WeightLoseGoal();
                    $newUser->fill($goalData);
                    $newUser->save();
                    return ['mobile_number' => $newUser->mobile_number,];
                } else {
                    return Constants::PATIENT_ALL_READY_EXIST_IN_PATIENT_GOAL_TABLE;
                }
            } else {
                return Constants::PARENT_RECORD_DOES_NOT_EXIST;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getWeightLoseGoalDetailsByMobileNumber($mobile_number)
    {
//        dd($mobile_number);
//        dd(WeightLoseGoal::find($mobile_number)->toArray());
        try {
            return WeightLoseGoal::where('mobile_number', $mobile_number)->firstOrFail()->toArray();
//            dd(WeightLoseGoal::where('mobile_number', $mobile_number)->firstOrFail()->toArray());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addDoctorRecommendation($data)
    {

        try {
            $doctorRecommendation = new DoctorRecommendation();
            $doctorRecommendation->fill($data);
            $doctorRecommendation->save();
            return true;
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public function getPreviousRecommendationByMobileNumber($mobile_number)
    {
        try {
            return DoctorRecommendation::where('mobile_number', $mobile_number)->get()->toArray();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $mobile_number
     * @return array|string
     */

    public function getDailyStatus($mobile_number): array|string
    {
        try {
            $patientPersonalDetails = Patient::find($mobile_number)->firstOrFail()->toArray();
            $patientHealthDetails = Patient::find($mobile_number)->getPatientMedicalRatio->toArray();
            $patientGoal = Patient::find($mobile_number)->getPatientGoal->toArray();
            $patientRecommendation = Patient::find($mobile_number)->getPatientRecommendation->toArray();

            return array_merge($patientPersonalDetails, $patientHealthDetails, $patientGoal, $patientRecommendation);

        } catch (\Exception $e) {
            return $e->getCode();
        }

    }

    public function editPatientByMobileNumber($data)
    {
        $patientPatientGoalDetails = Patient::find($data['mobile_number'])->getPatientGoalDetails->toArray();
//        dd($patientPatientGoalDetails);
        unset($patientPatientGoalDetails["id"]);
//        dd($patientPatientGoalDetails);
        $previousGoalDetails = new PreviousGoalDetails();
        $previousGoalDetails->fill($patientPatientGoalDetails);
        $previousGoalDetails->save();
        WeightLoseGoal::where(['mobile_number' => $data['mobile_number']])->update(
            [
                'goal_id' => $data['goal_id'],
                'goal' => $data['goal'],
                'target_weight' => $data['target_weight'],
                'desired_time_frame' => $data['desired_time_frame'],
                'how_much_do_you_love_food' => $data['how_much_do_you_love_food'],
                'how_would_you_rate_your_self_control' => $data['how_would_you_rate_your_self_control'],
                'how_many_times_week_do_i_exercise' => $data['how_many_times_week_do_i_exercise'],
                'motivation_factor_for_goal_manual' => $data['motivation_factor_for_goal_manual'],
                'motivation_factor_for_goal_selected' => $data['motivation_factor_for_goal_selected'],
                'level_of_motivation' => $data['level_of_motivation'],
                'motivation_target_10_text' => $data['motivation_target_10_text'],
                'contribute_favtors_selected' => $data['contribute_favtors_selected'],
                'no_one_fouca_factor' => $data['no_one_fouca_factor'],
                'previously_attempted' => $data['previously_attempted'],
                'attempted_yes_success_factors' => $data['attempted_yes_success_factors'],
                'attempted_yes_success_challenges' => $data['attempted_yes_success_challenges'],
                'attempted_no_success_factors' => $data['attempted_no_success_factors'],
                'attempted_no_success_challenges' => $data['attempted_no_success_challenges'],
                'what_stopped_you_from_continue' => $data['what_stopped_you_from_continue'],
                'what_has_prevented_you_from_restarting' => $data['what_has_prevented_you_from_restarting'],
                'what_stopped_you_from_continuing_to_lose_weight' => $data['what_stopped_you_from_continuing_to_lose_weight'],
                'what_has_prevented_you_from_trying_again' => $data['what_has_prevented_you_from_trying_again'],
                'in_the_reasons_for_current_weight' => $data['in_the_reasons_for_current_weight'],
                'confident_factor' => $data['confident_factor'],
                'confident_to_change_encouragement' => $data['confident_to_change_encouragement'],
                'how_hard_have_you_really_tried_to_lose_weight' => $data['how_hard_have_you_really_tried_to_lose_weight'],
                'roughly_how_many_times_have_you_tried' => $data['roughly_how_many_times_have_you_tried'],
                'look_forward_factors' => $data['look_forward_factors'],
            ]
        );
    }

    public function addPatientRecommendedTask($data)
    {
        try {
            $isUserExist = RecommendedTasks::where('mobile_number', $data['mobile_number'])->exists();
            if ($isUserExist) {
                $recommendedDetails = RecommendedTasks::where('mobile_number', $data['mobile_number'])->firstOrFail()->toArray();
                $previousRecommendedTasks = $recommendedDetails['recommended_tasks'];
                $latestRecommendedTask = $recommendedDetails['previous_recommended_tasks'];

                RecommendedTasks::where(['mobile_number' => $data['mobile_number']])->update(
                    [
                        'recommended_tasks' => $data['recommended_tasks'],
                        'previous_recommended_tasks' => $previousRecommendedTasks.$latestRecommendedTask
                    ]
                );
            } else {
                $newRecommendedTasks = new RecommendedTasks();
                $newRecommendedTasks->fill($data);
                $newRecommendedTasks->save();

            }


        } catch (\Exception $e) {
            return $e->getCode();
        }

    }

    public function getPatientRecommendedTask($mobile_number)
    {
        try {
            return RecommendedTasks::where('mobile_number', $mobile_number)->firstOrFail()->toArray();
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public function checkRecommendedTaskStatus($mobile_number,$patientRecommendedTask_1)
    {
        try {
            return PatientDailyStatus::where('mobile_number', $mobile_number)->where('recommended_task', $patientRecommendedTask_1)->get()->toArray();
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public function patientFollowUp($followUpDetails)
    {
        try {
//            dd($followUpDetails);
            $patientFollowUp = new PatientFollowUp();
            $patientFollowUp->fill($followUpDetails);
            $patientFollowUp->save();
            return ['mobile_number' => $patientFollowUp->mobile_number,];
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public function getPatientFollowUpDetailsByMobileNumber($mobile_number): mixed
    {
        try {
            return PatientFollowUp::where('mobile_number', $mobile_number)->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPatientDailyStatusByMobileNumber($mobile_number, $from_date, $to_date): mixed
    {
        try {
//            dd(PatientDailyStatus::select('how_much_did_you_enjoy_today','how_easy_it_was_the_goal_to_complete','how_fun_was_the_goal','complete_the_goal_tomorrow_rate')->where('mobile_number', $mobile_number)->whereBetween('eval_date', [$from_date, $to_date])->get());
//            return PatientDailyStatus::select('how_much_did_you_enjoy_today','how_easy_it_was_the_goal_to_complete','how_fun_was_the_goal','complete_the_goal_tomorrow_rate')->where('mobile_number', $mobile_number)->whereBetween('eval_date', [$from_date, $to_date])->get();
            return PatientDailyStatus::select('recommended_task', 'how_much_did_you_enjoy_today','how_easy_it_was_the_goal_to_complete','how_fun_was_the_goal','complete_the_goal_tomorrow_rate')->where([['mobile_number', '=', $mobile_number], ['follow_rec', '=', 'Yes'],])->whereBetween('eval_date', [$from_date, $to_date])->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPatientNoFollowRec($mobile_number, $from_date, $to_date)
    {
        try {
//            dd($mobile_number);
//            dd(PatientDailyStatus::select('recommended_task','failure_reason')->whereBetween('eval_date', [$from_date, $to_date])->where('mobile_number', $mobile_number)->where('follow_rec', 'No')->get()->toArray());
            return PatientDailyStatus::select('recommended_task','failure_reason')->whereBetween('eval_date', [$from_date, $to_date])->where('mobile_number', $mobile_number)->where('follow_rec', 'No')->get()->toArray();
//            whereBetween('eval_date', [$from_date, $to_date])->where('failure_reason', 'No')->get()->toArray());
//            return PatientDailyStatus::select('all')->where('mobile_number', $mobile_number)->whereBetween('eval_date', [$from_date, $to_date])->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllPatientByFollowRec($from_date,$to_date, $follow_rec)
    {
        try {
            if ($follow_rec === 'Yes')
                return PatientDailyStatus::select('eval_date', 'follow_rec', 'how_much_did_you_enjoy_today','how_easy_it_was_the_goal_to_complete','how_fun_was_the_goal','complete_the_goal_tomorrow_rate')->where([['recommended_task', '!=', null], ['follow_rec', '=', $follow_rec],])->whereBetween('eval_date', [$from_date, $to_date])->get();
            else
                return PatientDailyStatus::select('eval_date', 'follow_rec', 'failure_reason')->whereBetween('eval_date', [$from_date, $to_date])->where([['recommended_task', '!=', null], ['follow_rec', '=', $follow_rec],])->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAlert()
    {
        return Alert::all();
    }

    public function getVideoUrlByVideoId($vid_id)
    {
        try {
            return VideoUrl::where('video_id', $vid_id)->get();
        }catch (\Exception $exception){
            return  $exception->getMessage();
        }
    }
}
