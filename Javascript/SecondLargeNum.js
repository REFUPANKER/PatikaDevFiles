let nums = [2, 3, 6, 6, 5];
function GetMax(nums) {
    let max = nums[0];
    for (let i = 0; i < nums.length; i++) {
        if (nums[i] > max) {
            max = nums[i];
        }
    }
    return max;
}
function getSecondLargestNum(numx) {
    let max = GetMax(nums);
    let na = [];
    for (let i = 0; i < nums.length; i++) {
        if (nums[i] < max) {
            na.push(nums[i]);
        }
    }
    return GetMax(na);
}


console.log(getSecondLargestNum(nums));    