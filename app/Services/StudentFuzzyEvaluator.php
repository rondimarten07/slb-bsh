<?php

namespace App\Services;

class StudentFuzzyEvaluator
{
    public function evaluate($attitude, $knowledgeScore, $skillScore)
    {
        // Fuzzify inputs
        $attitudeLevel = $this->fuzzifyAttitude($attitude);
        $knowledgeLevel = $this->fuzzifyKnowledgeSkill($knowledgeScore);
        $skillLevel = $this->fuzzifyKnowledgeSkill($skillScore);

        // Apply fuzzy rules
        $performance = $this->applyRules($attitudeLevel, $knowledgeLevel, $skillLevel);

        return $performance;
    }

    private function fuzzifyAttitude($value)
    {
        if ($value >= 0 && $value <= 40) {
            return 'poor';
        } elseif ($value > 40 && $value <= 70) {
            return 'fair';
        } else {
            return 'good';
        }
    }

    private function fuzzifyKnowledgeSkill($value)
    {
        if ($value >= 0 && $value <= 40) {
            return 'low';
        } elseif ($value > 40 && $value <= 70) {
            return 'medium';
        } else {
            return 'high';
        }
    }

    private function applyRules($attitude, $knowledge, $skill)
    {
        // Excellent
        if ($attitude === 'good' && $knowledge === 'high' && $skill === 'high') {
            return 'Sangat Baik';
        }

        // Good
        if (($attitude === 'fair' && $knowledge === 'medium' && $skill === 'medium') ||
            ($attitude === 'good' && $knowledge === 'medium') ||
            ($knowledge === 'high' && $skill === 'high' && $attitude === 'fair')) {
            return 'Baik';
        }

        // Average
        if ($attitude === 'good' && $knowledge === 'medium') {
            return 'Cukup Baik';
        }

        // Bad (catch all else)
        if ($attitude === 'poor' || $knowledge === 'low' || $skill === 'low') {
            return 'Kurang Baik';
        }

        // Default fallback
        return 'Cukup Baik';
    }
}
