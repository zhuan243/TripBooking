library("RCurl")
library("rpart")
library("rpart.plot")
library("randomForest")
library("class")
library("e1071")
library("FNN")

#get the labeled data
spotifyLabeled <- read.csv("spotifyMusic_labledSet.csv", header=TRUE)

#take a look at the summary of the data
head(spotifyLabeled)
summary(spotifyLabeled)

#can see that like is the factor. Let's see what types of results this factor has
unique(spotifyLabeled$like)
#we see that a happy face and sad face is the result. Let's convert them to be more readable. Y = like, N = dislike

spotifyLabeled$like = ifelse(spotifyLabeled$like == ":)", "Y", "N")
unique(spotifyLabeled$like)
#check if changes were applied


#change the factor to the appropriate type
spotifyLabeled$like = factor(spotifyLabeled$like)
summary(spotifyLabeled)


#since we can see that the determinant or the result we want is categorized into two, some potential
#models we can consider are SVM, Random Forests, or KNN

#we can set a seed and split the data into a testing and training set that will be used for all the models
#setting seed so that comparison between the models are standardized

set.seed(12343)
num_samples = dim(spotifyLabeled)[1]
sampling.rate = 0.8
training <- sample(1:num_samples, sampling.rate * num_samples, replace=FALSE)
trainingSet <- subset(spotifyLabeled[training, ])
testing <- setdiff(1:num_samples,training)
testingSet <- subset(spotifyLabeled[testing, ])

#we can start with random forest
RandForestModel <- randomForest(like  ~., data = trainingSet)
plot(RandForestModel)

#around 250 trees is when the line begins to flatten and error rate is decreasing marginally. 
#set as 250 trees to optimize performance
RandForestModel <- randomForest(like  ~., data = trainingSet, ntree=250)
plot(RandForestModel)

#calculate the error rate of random forests
predictions<-predict(RandForestModel, testingSet)
# Calculate the error as the difference between the prediction and the actual
error = sum(predictions != testingSet$like)
sizeTestSet = dim(testingSet)[1]
misclassification_rate_randFor = error/sizeTestSet
print(misclassification_rate_randFor) #20.83% Error rate for rand forest


#calculate the error rate of KNN
#standarize the dataSet
spotifyLabeledStandardized = spotifyLabeled
summary(spotifyLabeledStandardized)
cols = ncol(spotifyLabeled)-1
for(i in 1:cols){
  spotifyLabeledStandardized[,i] <- (spotifyLabeled[,i] - mean(spotifyLabeled[,i]))/sd(spotifyLabeled[,i]) }
summary(spotifyLabeledStandardized)


#create training and testing based on standardized data
num_samples = dim(spotifyLabeledStandardized)[1]
sampling.rate = 0.8
trainingKNN <- sample(1:num_samples, sampling.rate * num_samples, replace=FALSE)
trainingSetKNN <- subset(spotifyLabeledStandardized[trainingKNN, ])
testingKNN <- setdiff(1:num_samples,trainingKNN)
testingSetKNN <- subset(spotifyLabeledStandardized[testingKNN, ])


#get features
# Get the features of the training set
trainingfeatures <- subset(trainingSetKNN, select=c(-like))
# Get the labels of the training set
traininglabels <- trainingSetKNN$like
# Get the features of the testing set
testingfeatures <- subset(testingSetKNN, select=c(-like))


#run the model
predictedLabels = knn(trainingfeatures,testingfeatures,traininglabels,k=3)
# Get the number of data points in the data set
sizeTestSet = dim(testingSetKNN)[1]
# Get the number of data points that are misclassified
error = sum(predictedLabels != testingSetKNN$like)
# Calculate the misclassification rate
misclassification_rateKNN = error/sizeTestSet
# Display the misclassification rate
print(misclassification_rateKNN) #25% error rate

#check different k's
predictedLabels = knn(trainingfeatures,testingfeatures,traininglabels,k=5)
# Get the number of data points in the data set
sizeTestSet = dim(testingSetKNN)[1]
# Get the number of data points that are misclassified
error = sum(predictedLabels != testingSetKNN$like)
# Calculate the misclassification rate
misclassification_rateKNN = error/sizeTestSet
# Display the misclassification rate
print(misclassification_rateKNN) #20.833% error rate

#check different k's
predictedLabels = knn(trainingfeatures,testingfeatures,traininglabels,k=7)
# Get the number of data points in the data set
sizeTestSet = dim(testingSetKNN)[1]
# Get the number of data points that are misclassified
error = sum(predictedLabels != testingSetKNN$like)
# Calculate the misclassification rate
misclassification_rateKNN = error/sizeTestSet
# Display the misclassification rate
print(misclassification_rateKNN) #20.833% error rate

#the difference in error rate goes down at k = 5 and does not change at k = 7. We will stick with k = 5.
#same error rate as random forests so can use either.

#SVM
svmModel <- svm(like ~., data=trainingSet, kernel="linear", cost=20)

predictedLabels <-predict(svmModel, testingSet)
sizeTestSet = dim(testingSet)[1]
# Get the number of data points that are misclassified
error = sum(predictedLabels != testingSet$like)
# Calculate the misclassification rate
misclassification_rateSVM = error/sizeTestSet
# Display the misclassification rate
print(misclassification_rateSVM) #8.3% error rate
#SVM has the least error rate and we can should use this to label the unlabelled set. 
#To increase accuracy, we can get the average error rate by running through many different training and testing sets
#for the purpose of time, I will just run this once with a standardized training/testing set.


#label the set that is unlabelled
spotifyUnlabeled <- read.csv("spotifyMusic_unlabledSet.csv", header=TRUE)


spotifyUnlabeled$like = factor(spotifyUnlabeled$like)
summary(spotifyUnlabeled)

predictedLabelsSVMFinal <-predict(svmModel, spotifyUnlabeled)
spotifyUnlabeled$like = predictedLabelsSVMFinal

summary(spotifyUnlabeled)

spotifyUnlabeled$like

